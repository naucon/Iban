<?php
/*
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Iban;

/**
 * IBAN Class
 * International Bank Account Number (IBAN)
 *
 * @package    Iban
 * @author     Sven Sanzenbacher
 */
class Iban
{
    /**
     * @var         string                  iban
     */
    protected $iban = null;

    /**
     * @var         array                   map of iban country Specifics
     *
     * schema definition
     * c = country code
     * d = check digits
     * b = bankcode
     * s = branch code
     * a = account number
     * x = not specified, or country
     */
    public $countryMap = array(
        'AD' => array(
            'country' => 'Andorra',
            'length' => 24,
            'bankcode' => array(4, 4),
            'account' => array(12, 12),
            'schema' => 'ccdd bbbb ssss aaaa aaaa aaaa'),
        'AE' => array(
            'country' => 'United Arab Emirates',
            'length' => 23,
            'bankcode' => array(4, 3),
            'account' => array(7, 16),
            'schema' => 'ccdd bbba aaaa aaaa aaaa aaa'),
        'AL' => array(
            'country' => 'Albania',
            'length' => 28,
            'bankcode' => array(4, 3),
            'account' => array(12, 16),
            'schema' => 'ccdd bbbs sssx aaaa aaaa aaaa aaaa'),
        'AT' => array(
            'country' => 'Austria',
            'length' => 20,
            'bankcode' => array(4, 5),
            'account' => array(9, 11),
            'schema' => 'ccdd bbbb baaa aaaa aaaa'),
        'AZ' => array(
            'country' => 'Azerbaijan',
            'length' => 28,
            'bankcode' => array(4, 4),
            'account' => array(8, 20),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa aaaa aaaa'),
        'BA' => array(
            'country' => 'Bosnia and Herzegovina',
            'length' => 20,
            'bankcode' => array(4, 3),
            'account' => array(10, 8),
            'schema' => 'ccdd bbbs ssaa aaaa aaxx'),
        'BE' => array(
            'country' => 'Belgium',
            'length' => 16,
            'bankcode' => array(4, 3),
            'account' => array(7, 7),
            'schema' => 'ccdd bbba aaaa aaxx'),
        'BG' => array(
            'country' => 'Bulgaria',
            'length' => 22,
            'bankcode' => array(4, 4),
            'account' => array(14, 8),
            'schema' => 'ccdd bbbb ssss xxaa aaaa aa'),
        'BH' => array(
            'country' => 'Bahrain',
            'length' => 22,
            'bankcode' => array(4, 4),
            'account' => array(8, 14),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa aa'),
        'BR' => array(
            'country' => 'Brazil',
            'length' => 29,
            'bankcode' => array(4, 8),
            'account' => array(17, 12),
            'schema' => 'ccdd bbbb bbbb ssss saaa aaaa aaaa a'),
        'BL' => array(
            'country' => 'Saint Barthélemy',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'CH' => array(
            'country' => 'Switzerland',
            'length' => 21,
            'bankcode' => array(4, 5),
            'account' => array(9, 12),
            'schema' => 'ccdd bbbb baaa aaaa aaaa a'),
        'CR' => array(
            'country' => 'Costa Rica',
            'length' => 21,
            'bankcode' => array(4, 3),
            'account' => array(7, 14),
            'schema' => 'ccdd bbba aaaa aaaa aaaa a'),
        'CY' => array(
            'country' => 'Cyprus',
            'length' => 28,
            'bankcode' => array(4, 3),
            'account' => array(12, 16),
            'schema' => 'ccdd bbbs ssss aaaa aaaa aaaa aaaa'),
        'CZ' => array(
            'country' => 'Czech Republic',
            'length' => 24,
            'bankcode' => array(4, 4),
            'account' => array(8, 16),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa aaaa'),
        'DE' => array(
            'country' => 'Germany',
            'length' => 22,
            'bankcode' => array(4, 8),
            'account' => array(12, 10),
            'schema' => 'ccdd bbbb bbbb aaaa aaaa aa'),
        'DK' => array(
            'country' => 'Denmark',
            'length' => 18,
            'bankcode' => array(4, 4),
            'account' => array(8, 9),
            'schema' => 'ccdd bbbb aaaa aaaa ax'),
        'DO' => array(
            'country' => 'Dominican Republic',
            'length' => 28,
            'bankcode' => array(4, 4),
            'account' => array(8, 20),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa aaaa aaaa'),
        'EE' => array(
            'country' => 'Estonia',
            'length' => 20,
            'bankcode' => array(4, 2),
            'account' => array(6, 13),
            'schema' => 'ccdd bbaa aaaa aaaa aaax'),
        'ES' => array(
            'country' => 'Spain',
            'length' => 24,
            'bankcode' => array(4, 4),
            'account' => array(14, 10),
            'schema' => 'ccdd bbbb ssss xxaa aaaa aaaa'),
        'FI' => array(
            'country' => 'Finland',
            'length' => 18,
            'bankcode' => array(4, 6),
            'account' => array(10, 7),
            'schema' => 'ccdd bbbb bbaa aaaa ax'),
        'FO' => array(
            'country' => 'Faroe Islands',
            'length' => 18,
            'bankcode' => array(4, 4),
            'account' => array(8, 9),
            'schema' => 'ccdd bbbb aaaa aaaa ax'),
        'FR' => array(
            'country' => 'France',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'GB' => array(
            'country' => 'United Kingdom',
            'length' => 22,
            'bankcode' => array(4, 4),
            'account' => array(14, 8),
            'schema' => 'ccdd bbbb ssss ssaa aaaa aa'),
        'GE' => array(
            'country' => 'Georgia',
            'length' => 22,
            'bankcode' => array(4, 2),
            'account' => array(6, 16),
            'schema' => 'ccdd bbaa aaaa aaaa aaaa aa'),
        'GF' => array(
            'country' => 'French Guiana',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'GI' => array(
            'country' => 'Gibraltar',
            'length' => 23,
            'bankcode' => array(4, 4),
            'account' => array(8, 15),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa aaa'),
        'GL' => array(
            'country' => 'Greenland',
            'length' => 18,
            'bankcode' => array(4, 4),
            'account' => array(8, 9),
            'schema' => 'ccdd bbbb aaaa aaaa ax'),
        'GP' => array(
            'country' => 'Guadeloupe',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'GR' => array(
            'country' => 'Greece',
            'length' => 27,
            'bankcode' => array(4, 3),
            'account' => array(11, 16),
            'schema' => 'ccdd bbbs sssa aaaa aaaa aaaa aaa'),
        'GT' => array(
            'country' => 'Guatemala',
            'length' => 28,
            'bankcode' => array(4, 4),
            'account' => array(8, 20),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa aaaa aaaa'),
        'HK' => array(
            'country' => 'Hong Kong',
            'length' => 16,
            'bankcode' => array(4, 4),
            'account' => array(8, 8),
            'schema' => 'ccdd bbbb aaaa aaaa'),
        'HR' => array(
            'country' => 'Croatia',
            'length' => 21,
            'bankcode' => array(4, 7),
            'account' => array(11, 10),
            'schema' => 'ccdd bbbb bbba aaaa aaaa a'),
        'HU' => array(
            'country' => 'Hungary',
            'length' => 28,
            'bankcode' => array(4, 3),
            'account' => array(12, 15),
            'schema' => 'ccdd bbbs sssx aaaa aaaa aaaa aaax'),
        'IE' => array(
            'country' => 'Ireland',
            'length' => 22,
            'bankcode' => array(4, 4),
            'account' => array(14, 8),
            'schema' => 'ccdd bbbb ssss ssaa aaaa aa'),
        'IL' => array(
            'country' => 'Israel',
            'length' => 23,
            'bankcode' => array(4, 3),
            'account' => array(10, 13),
            'schema' => 'ccdd bbbs ssaa aaaa aaaa aaa'),
        'IS' => array(
            'country' => 'Iceland',
            'length' => 26,
            'bankcode' => array(4, 4),
            'account' => array(10, 6),
            'schema' => 'ccdd bbbb ssaa aaaa xxxx xxxx xx'),
        'IT' => array(
            'country' => 'Italy',
            'length' => 27,
            'bankcode' => array(5, 5),
            'account' => array(15, 12),
            'schema' => 'ccdd xbbb bbss sssa aaaa aaaa aaa'),
        'KW' => array(
            'country' => 'Kuwait',
            'length' => 30,
            'bankcode' => array(4, 4),
            'account' => array(8, 22),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa aaaa aaaa aa'),
        'KZ' => array(
            'country' => 'Kazakhstan',
            'length' => 20,
            'bankcode' => array(4, 3),
            'account' => array(7, 13),
            'schema' => 'ccdd bbba aaaa aaaa aaaa'),
        'LB' => array(
            'country' => 'Lebanon',
            'length' => 28,
            'bankcode' => array(4, 4),
            'account' => array(8, 20),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa aaaa aaaa'),
        'LI' => array(
            'country' => 'Liechtenstein',
            'length' => 21,
            'bankcode' => array(4, 5),
            'account' => array(9, 12),
            'schema' => 'ccdd bbbb baaa aaaa aaaa a'),
        'LU' => array(
            'country' => 'Luxembourg',
            'length' => 20,
            'bankcode' => array(4, 3),
            'account' => array(7, 13),
            'schema' => 'ccdd bbba aaaa aaaa aaaa'),
        'LV' => array(
            'country' => 'Latvia',
            'length' => 21,
            'bankcode' => array(4, 4),
            'account' => array(8, 13),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa a'),
        'LT' => array(
            'country' => 'Lithuania',
            'length' => 20,
            'bankcode' => array(4, 5),
            'account' => array(9, 11),
            'schema' => 'ccdd bbbb baaa aaaa aaaa'),
        'MA' => array(
            'country' => 'Morocco',
            'length' => 24,
            'bankcode' => array(4, 3),
            'account' => array(10, 12),
            'schema' => 'ccdd bbbs ssaa aaaa aaaa aaxx'),
        'MC' => array(
            'country' => 'Monaco',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'MD' => array(
            'country' => 'Moldova',
            'length' => 24,
            'bankcode' => array(4, 2),
            'account' => array(6, 18),
            'schema' => 'ccdd bbaa aaaa aaaa aaaa aaaa'),
        'ME' => array(
            'country' => 'Montenegro',
            'length' => 22,
            'bankcode' => array(4, 3),
            'account' => array(7, 13),
            'schema' => 'ccdd bbba aaaa aaaa aaaa xx'),
        'MF' => array(
            'country' => 'Collectivity of Saint Martin',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'MK' => array(
            'country' => 'Macedonia',
            'length' => 19,
            'bankcode' => array(4, 3),
            'account' => array(7, 10),
            'schema' => 'ccdd bbba aaaa aaaa axx'),
        'MU' => array(
            'country' => 'Mauritius',
            'length' => 30,
            'bankcode' => array(4, 6),
            'account' => array(12, 15),
            'schema' => 'ccdd bbbb bbss aaaa aaaa aaaa aaax xx'),
        'MQ' => array(
            'country' => 'Martinique',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'MR' => array(
            'country' => 'Mauritania',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'MT' => array(
            'country' => 'Malta',
            'length' => 31,
            'bankcode' => array(4, 4),
            'account' => array(13, 18),
            'schema' => 'ccdd bbbb ssss saaa aaaa aaaa aaaa aaa'),
        'NC' => array(
            'country' => 'New Caledonia',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'NL' => array(
            'country' => 'Netherlands',
            'length' => 18,
            'bankcode' => array(4, 4),
            'account' => array(8, 10),
            'schema' => 'ccdd bbbb aaaa aaaa aa'),
        'NO' => array(
            'country' => 'Norway',
            'length' => 15,
            'bankcode' => array(4, 4),
            'account' => array(8, 6),
            'schema' => 'ccdd bbbb aaaa aax'),
        'PF' => array(
            'country' => 'French Polynesia',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'PK' => array(
            'country' => 'Pakistan',
            'length' => 24,
            'bankcode' => array(4, 4),
            'account' => array(10, 14),
            'schema' => 'ccdd bbbb xxaa aaaa aaaa aaaa'),
        'PM' => array(
            'country' => 'Saint Pierre and Miquelon',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'PL' => array(
            'country' => 'Poland',
            'length' => 28,
            'bankcode' => array(4, 3),
            'account' => array(12, 16),
            'schema' => 'ccdd bbbs sssx aaaa aaaa aaaa aaaa'),
        'PS' => array(
            'country' => 'Palestinian',
            'length' => 29,
            'bankcode' => array(4, 4),
            'account' => array(17, 12),
            'schema' => 'ccdd bbbb xxxx xxxx xaaa aaaa aaaa a'),
        'PT' => array(
            'country' => 'Portugal',
            'length' => 25,
            'bankcode' => array(4, 4),
            'account' => array(12, 11),
            'schema' => 'ccdd bbbb ssss aaaa aaaa aaax x'),
        'RE' => array(
            'country' => 'Réunion',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'RO' => array(
            'country' => 'Romania',
            'length' => 24,
            'bankcode' => array(4, 4),
            'account' => array(8, 16),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa aaaa'),
        'RS' => array(
            'country' => 'Serbia',
            'length' => 22,
            'bankcode' => array(4, 3),
            'account' => array(7, 13),
            'schema' => 'ccdd bbba aaaa aaaa aaaa xx'),
        'SA' => array(
            'country' => 'Saudi Arabia',
            'length' => 24,
            'bankcode' => array(4, 2),
            'account' => array(6, 18),
            'schema' => 'ccdd bbaa aaaa aaaa aaaa aaaa'),
        'SE' => array(
            'country' => 'Sweden',
            'length' => 24,
            'bankcode' => array(4, 3),
            'account' => array(7, 16),
            'schema' => 'ccdd bbba aaaa aaaa aaaa aaax'),
        'SI' => array(
            'country' => 'Slovenia',
            'length' => 19,
            'bankcode' => array(4, 2),
            'account' => array(9, 8),
            'schema' => 'ccdd bbss saaa aaaa axx'),
        'SK' => array(
            'country' => 'Slovakia',
            'length' => 24,
            'bankcode' => array(4, 4),
            'account' => array(14, 10),
            'schema' => 'ccdd bbbb ssss ssaa aaaa aaaa'),
        'SM' => array(
            'country' => 'San Marino',
            'length' => 27,
            'bankcode' => array(5, 5),
            'account' => array(15, 12),
            'schema' => 'ccdd xbbb bbss sssa aaaa aaaa aaa'),
        'TF' => array(
            'country' => 'French Southern and Antarctic Lands',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'TN' => array(
            'country' => 'Tunisia',
            'length' => 24,
            'bankcode' => array(4, 2),
            'account' => array(9, 13),
            'schema' => 'ccdd bbss saaa aaaa aaaa aaxx'),
        'TR' => array(
            'country' => 'Turkey',
            'length' => 26,
            'bankcode' => array(4, 5),
            'account' => array(10, 16),
            'schema' => 'ccdd bbbb bxaa aaaa aaaa aaaa aa'),
        'VG' => array(
            'country' => 'Virgin Islands, British',
            'length' => 24,
            'bankcode' => array(4, 4),
            'account' => array(8, 16),
            'schema' => 'ccdd bbbb aaaa aaaa aaaa aaaa'),
        'WF' => array(
            'country' => 'Wallis and Futuna',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
        'YT' => array(
            'country' => 'Mayotte',
            'length' => 27,
            'bankcode' => array(4, 5),
            'account' => array(14, 11),
            'schema' => 'ccdd bbbb bsss ssaa aaaa aaaa axx'),
    );

    /**
     * @var         array                   char matching
     */
    protected $charMatching = array(
        'A' => 10,
        'B' => 11,
        'C' => 12,
        'D' => 13,
        'E' => 14,
        'F' => 15,
        'G' => 16,
        'H' => 17,
        'I' => 18,
        'J' => 19,
        'K' => 20,
        'L' => 21,
        'M' => 22,
        'N' => 23,
        'O' => 24,
        'P' => 25,
        'Q' => 26,
        'R' => 27,
        'S' => 28,
        'T' => 29,
        'U' => 30,
        'V' => 31,
        'W' => 32,
        'X' => 33,
        'Y' => 34,
        'Z' => 35
    );

    /**
     * Constructor
     *
     * @param       string      $iban       iban
     */
    public function __construct($iban)
    {
        $this->setIban($iban);
    }


    /**
     * @return      string                  iban
     */
    public function __toString()
    {
        return $this->getIban();
    }

    /**
     * @return      string                  iban
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param       string      $iban       iban
     * @return      void
     */
    public function setIban($iban)
    {
        $iban = trim($iban);
        $iban = preg_replace('/[^0-9A-Za-z]/', '', $iban);
        $iban = strtoupper($iban);
        $this->iban = $iban;
    }

    /**
     * returns the country code of a iban
     * the country code is corresponding to ISO 3166-1
     *
     * @return      string                  country code
     */
    public function getCountryCode()
    {
        $countryCode = '';
        $iban = $this->getIban();
        if (!empty($iban)) {
            $countryCode = substr($iban, 0, 2);
        }
        return $countryCode;
    }

    /**
     * @return      string                  country code
     */
    public function getCountryName()
    {
        $countryCode = $this->getCountryCode();
        if (array_key_exists($countryCode, $this->countryMap)) {
            return $this->countryMap[$countryCode]['country'];
        }
        return false;
    }

    /**
     * return the check digits of a iban
     * check digits corresponding to ISO 7064
     *
     * @return      string                  check digits
     */
    public function getCheckDigits()
    {
        $checkDigits = '';
        $iban = $this->getIban();
        if (!empty($iban)) {
            $checkDigits = substr($iban, 2, 2);
        }
        return $checkDigits;
    }

    /**
     * Basic Bank Account Number (BBAN)
     *
     * @return      string                  bban
     */
    public function getBban()
    {
        $bban = '';
        $iban = $this->getIban();
        if (!empty($iban)) {
            $bban = substr($iban, 4);
        }
        return $bban;
    }

    /**
     * @return      string                  bankcode in IBAN
     */
    public function getBankcode()
    {
        $countryCode = $this->getCountryCode();
        if (array_key_exists($countryCode, $this->countryMap)) {
            return substr($this->getIban(),
                $this->countryMap[$countryCode]['bankcode'][0],
                $this->countryMap[$countryCode]['bankcode'][1]);
        }
        return false;
    }

    /**
     * @return      string                  account in IBAN
     */
    public function getAccount()
    {
        $countryCode = $this->getCountryCode();
        if (array_key_exists($countryCode, $this->countryMap)) {
            return substr($this->getIban(),
                $this->countryMap[$countryCode]['account'][0],
                $this->countryMap[$countryCode]['account'][1]);
        }
        return false;
    }

    /**
     * @return      bool                    length is valid
     */
    public function isValidLength()
    {
        $countryCode = $this->getCountryCode();
        if (array_key_exists($countryCode, $this->countryMap)) {
            if (strlen($this->getIban()) == $this->countryMap[$countryCode]['length']) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return      bool
     */
    public function isValid()
    {
        $checkDigits = $this->calculateCheckDigits($this->getIban());

        if ($this->isValidLength()) {
            if ($checkDigits == $this->getCheckDigits()) {
                return true;
            }
        }
        return false;
    }

    /**
     * prepare check digits calculate
     *
     * @param       string      $iban       iban
     * @return      int                     conversion of value
     */
    public function prepareCheckDigitsCalculate($iban)
    {
        $firstPlaces = substr((string)$iban, 0, 2);
        $lastPlaces = substr((string)$iban, 4);
        $conversion = strtr((string)$lastPlaces . (string)$firstPlaces . '00', $this->charMatching);
        return $conversion;
    }

    /**
     * calculate check digits
     * (Modulo 97-10)
     *
     * @param       string      $iban       iban
     * @return      int                     checksum of iban
     */
    public function calculateCheckDigits($iban)
    {
        $value = $this->prepareCheckDigitsCalculate($iban);

        $modulo = null;
        $valueLength = strlen($value);
        $nextPosition = 0;
        $nextLength = 9;
        do {
            $subValue = substr($value, $nextPosition, $nextLength);
            $subValue = $modulo . $subValue;
            $modulo = $subValue % 97;

            $nextPosition += $nextLength;
            $nextLength = 9 - strlen($modulo);
        } while ($valueLength > $nextPosition);

        $checksum = 98 - $modulo;
        return (int)$checksum;
    }
}