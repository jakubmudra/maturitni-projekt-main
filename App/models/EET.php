<?php


namespace App\models;


use App\Config\Config;
use DateTime;
use FilipSedivy\EET\Certificate;
use FilipSedivy\EET\Dispatcher;
use FilipSedivy\EET\Receipt;
use Ramsey\Uuid\Uuid;

class EET
{
    public static function test(){
        $receipt = new Receipt();
        $receipt->uuid_zpravy = Uuid::uuid4()->toString();
        $receipt->id_provoz = '141';
        $receipt->id_pokl = '1patro-vpravo';
        $receipt->porad_cis = '141-18543-05';
        $receipt->dic_popl = 'CZ00000019';
        $receipt->dat_trzby = new DateTime;
        $receipt->celk_trzba = 500;

        $certificate = new Certificate(Config::$EETCert["path"], Config::$EETCert["password"]);
        $dispatcher = new Dispatcher($certificate, Dispatcher::PLAYGROUND_SERVICE);

        try {
            $dispatcher->send($receipt);

            echo 'FIK: ' . $dispatcher->getFik();
            echo 'BKP: ' . $dispatcher->getBkp();
        } catch (FilipSedivy\EET\Exceptions\EET\ClientException $exception) {
            echo 'BKP: ' . $exception->getBkp();
            echo 'PKP:' . $exception->getPkp();
        } catch (FilipSedivy\EET\Exceptions\EET\ErrorException $exception) {
            echo '(' . $exception->getCode() . ') ' . $exception->getMessage();
        } catch (FilipSedivy\EET\Exceptions\Receipt\ConstraintViolationException $violationException) {
            echo implode('<br>', $violationException->getErrors());
        }

        return $dispatcher;
    }
}