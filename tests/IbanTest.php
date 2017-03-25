<?php
/*
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Iban\Tests;

use Naucon\Iban\Iban;

class IbanTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return      void
     */
    public function testCountryMapIntegrity()
    {
        $type = new Iban(null);

        foreach ($type->countryMap as $countryIso => $definition) {
            $countrySchema = str_replace(' ', '', $type->countryMap[$countryIso]['schema']);

            $this->assertEquals(strlen($countrySchema), $type->countryMap[$countryIso]['length']);
            $this->assertEquals(strpos($countrySchema, 'b'), $type->countryMap[$countryIso]['bankcode'][0]);
            $this->assertEquals(substr_count($countrySchema, 'b'), $type->countryMap[$countryIso]['bankcode'][1]);
            $this->assertEquals(strpos($countrySchema, 'a'), $type->countryMap[$countryIso]['account'][0]);
            $this->assertEquals(substr_count($countrySchema, 'a'), $type->countryMap[$countryIso]['account'][1]);
        }
    }

    /**
     * @return      void
     */
    public function testGetIban()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertEquals('DE68210501700012345678', $type->getIban());

        $type = new Iban('CH10002300A1023502601');
        $this->assertEquals('CH10002300A1023502601', $type->getIban());
    }

    /**
     * @return      void
     */
    public function testGetBban()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertEquals('210501700012345678', $type->getBban());

        $type = new Iban('CH10002300A1023502601');
        $this->assertEquals('002300A1023502601', $type->getBban());
    }

    /**
     * @return      void
     */
    public function testGetCountryCode()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertEquals('DE', $type->getCountryCode());

        $type = new Iban('CH10002300A1023502601');
        $this->assertEquals('CH', $type->getCountryCode());
    }

    /**
     * @return      void
     */
    public function testGetCountryName()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertEquals('Germany', $type->getCountryName());

        $type = new Iban('CH10002300A1023502601');
        $this->assertEquals('Switzerland', $type->getCountryName());
    }

    /**
     * @return      void
     */
    public function testGetCheckDigits()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertEquals('68', $type->getCheckDigits());

        $type = new Iban('CH10002300A1023502601');
        $this->assertEquals('10', $type->getCheckDigits());
    }

    /**
     * @return      void
     */
    public function testGetBankcode()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertEquals('21050170', $type->getBankcode());

        $type = new Iban('CH10002300A1023502601');
        $this->assertEquals('00230', $type->getBankcode());
    }

    /**
     * @return      void
     */
    public function testGetAccount()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertEquals('0012345678', $type->getAccount());

        $type = new Iban('CH10002300A1023502601');
        $this->assertEquals('0A1023502601', $type->getAccount());
    }

    /**
     * @return      void
     */
    public function testIsValidLength()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertTrue($type->isValidLength());

        $type = new Iban('DE682105017000123456780');
        $this->assertFalse($type->isValidLength());

        $type = new Iban('CH10002300A1023502601');
        $this->assertTrue($type->isValidLength());

        $type = new Iban('CH10002300A10235026010');
        $this->assertFalse($type->isValidLength());
    }

    /**
     * @return      void
     */
    public function testPrepareCheckDigitsCalculate()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertEquals('210501700012345678131400', $type->prepareCheckDigitsCalculate('DE68210501700012345678'));

        $type = new Iban('CH10002300A1023502601');
        $this->assertEquals('002300101023502601121700', $type->prepareCheckDigitsCalculate('CH10002300A1023502601'));
    }

    /**
     * @return      void
     */
    public function testChecksum()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertEquals(68, $type->calculateCheckDigits('DE68210501700012345678'));

        $type = new Iban('CH10002300A1023502601');
        $this->assertEquals(10, $type->calculateCheckDigits('CH10002300A1023502601'));
    }

    /**
     * @return      void
     */
    public function testIsValid()
    {
        $type = new Iban('DE68210501700012345678');
        $this->assertTrue($type->isValid());

        $type = new Iban('DE69210501700012345678');
        $this->assertFalse($type->isValid());

        $type = new Iban('CH10002300A1023502601');
        $this->assertTrue($type->isValid());

        $type = new Iban('CH00002300A1023502601');
        $this->assertFalse($type->isValid());
    }
}