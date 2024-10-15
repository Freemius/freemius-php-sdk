<?php
/**
 * How to set up and run tests:
 *
 * 1. Install PHPUnit via Composer:
 *    composer require --dev phpunit/phpunit
 *
 * 2. Copy the `credentials.example.php` file to `credentials.php` and fill in your actual credentials:
 *    cp tests/credentials.example.php tests/credentials.php
 *    // Then edit `tests/credentials.php` to include your actual API credentials.
 *
 * 3. Run the tests using PHPUnit:
 *    vendor/bin/phpunit
 */
use PHPUnit\Framework\TestCase;

class GetLicenseDataTest extends TestCase
{
    public function testLicenseData()
    {
        require_once 'credentials.php';
        require_once '../freemius/FreemiusBase.php';
        require_once '../freemius/Freemius.php';

        $api = new Freemius_Api(
            FS__API_SCOPE,
            FS__API_ID,
            FS__API_PUBLIC_KEY,
            FS__API_SECRET_KEY
        );

        $license_key = 'sk_rr_s^T6x3aT^vpE-teFhtgZXjjhk3';

        $result = $api->Api("/licenses.json", "GET", array(
            'search' => ($license_key),
        ));

        $this->assertIsArray($result->licenses, 'Licenses should be an array');
        $this->assertCount(1, $result->licenses, 'There should be exactly one license');
        $this->assertEquals($license_key, $result->licenses[0]->secret_key, 'The secret key should match the provided license key');
    }
}
