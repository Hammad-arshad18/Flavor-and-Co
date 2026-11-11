<?php
declare(strict_types=1);

/**
 * Send a plain-text message over implicit SSL SMTP (port 465).
 * Returns [bool $sent, string $error].
 */
function smtp_send(string $to, string $subject, string $body, string $replyTo): array
{
    if (!filter_var($to, FILTER_VALIDATE_EMAIL) || !filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
        return [false, 'Invalid recipient or reply-to address.'];
    }

    $context = stream_context_create([
        'ssl' => [
            'verify_peer' => true,
            'verify_peer_name' => true,
            'SNI_enabled' => true,
        ],
    ]);

    $errno = 0;
    $errstr = '';
    $socket = @stream_socket_client(
        'ssl://' . SMTP_HOST . ':' . SMTP_PORT,
        $errno,
        $errstr,
        20,
        STREAM_CLIENT_CONNECT,
        $context
    );

    if (!is_resource($socket)) {
        return [false, 'SMTP connection failed: ' . $errstr . ' (' . $errno . ')'];
    }

    stream_set_timeout($socket, 20);

    $read = static function () use ($socket): string {
        $response = '';
        while (!feof($socket)) {
            $line = fgets($socket, 515);
            if ($line === false) {
                break;
            }
            $response .= $line;
            if (strlen($line) < 4 || $line[3] === ' ') {
                break;
            }
        }

        return $response;
    };

    $write = static function (string $line) use ($socket): void {
        fwrite($socket, $line . "\r\n");
    };

    $fail = static function (string $message) use ($socket): array {
        @fclose($socket);
        return [false, $message];
    };

    $response = $read();
    if ((int) substr($response, 0, 3) !== 220) {
        return $fail('SMTP greeting failed: ' . trim($response));
    }

    $write('EHLO ' . (gethostname() ?: 'localhost'));
    $response = $read();
    if ((int) substr($response, 0, 3) !== 250) {
        return $fail('SMTP EHLO failed: ' . trim($response));
    }

    $write('AUTH LOGIN');
    $response = $read();
    if ((int) substr($response, 0, 3) !== 334) {
        return $fail('SMTP AUTH LOGIN rejected: ' . trim($response));
    }

    $write(base64_encode(SMTP_USER));
    $response = $read();
    if ((int) substr($response, 0, 3) !== 334) {
        return $fail('SMTP username rejected: ' . trim($response));
    }

    $write(base64_encode(SMTP_PASS));
    $response = $read();
    if ((int) substr($response, 0, 3) !== 235) {
        return $fail('SMTP authentication failed: ' . trim($response));
    }

    $write('MAIL FROM:<' . SMTP_USER . '>');
    $response = $read();
    if ((int) substr($response, 0, 3) !== 250) {
        return $fail('SMTP MAIL FROM rejected: ' . trim($response));
    }

    $write('RCPT TO:<' . $to . '>');
    $response = $read();
    if (!in_array((int) substr($response, 0, 3), [250, 251], true)) {
        return $fail('SMTP RCPT TO rejected: ' . trim($response));
    }

    $write('DATA');
    $response = $read();
    if ((int) substr($response, 0, 3) !== 354) {
        return $fail('SMTP DATA rejected: ' . trim($response));
    }

    $senderDomain = substr((string) strrchr(SMTP_USER, '@'), 1) ?: SMTP_FALLBACK_DOMAIN;

    $headers = [
        'Date: ' . date('r'),
        'From: ' . SMTP_FROM_NAME . ' <' . SMTP_USER . '>',
        'To: <' . $to . '>',
        'Reply-To: <' . $replyTo . '>',
        'Subject: =?UTF-8?B?' . base64_encode($subject) . '?=',
        'Message-ID: <' . bin2hex(random_bytes(12)) . '@' . $senderDomain . '>',
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
    ];

    $message = implode("\r\n", $headers) . "\r\n\r\n" . $body;
    $message = str_replace(["\r\n", "\r"], "\n", $message);
    $message = str_replace("\n", "\r\n", $message);
    $message = preg_replace('/^\./m', '..', $message) ?? $message;

    fwrite($socket, $message . "\r\n.\r\n");

    $response = $read();
    if ((int) substr($response, 0, 3) !== 250) {
        return $fail('SMTP message rejected: ' . trim($response));
    }

    $write('QUIT');
    @fclose($socket);

    return [true, ''];
}
