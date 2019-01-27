<?php

namespace wdmg\geo\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

use yii\helpers\Console;
use yii\helpers\BaseFileHelper;
use yii\httpclient\Client;
use yii\helpers\ArrayHelper;

class InitController extends Controller
{
    /**
     * @inheritdoc
     */
    public $defaultAction = 'index';

    public function actionIndex($params = null)
    {
        $version = Yii::$app->controller->module->version;
        $welcome =
            '╔════════════════════════════════════════════════╗'. "\n" .
            '║                                                ║'. "\n" .
            '║              GEO MODULE, v.'.$version.'               ║'. "\n" .
            '║          by Alexsander Vyshnyvetskyy           ║'. "\n" .
            '║         (c) 2019 W.D.M.Group, Ukraine          ║'. "\n" .
            '║                                                ║'. "\n" .
            '╚════════════════════════════════════════════════╝';
        echo $name = $this->ansiFormat($welcome . "\n\n", Console::FG_GREEN);
        echo "Select the operation you want to perform:\n";
        echo "  1) Apply all module migrations\n";
        echo "  2) Revert all module migrations\n";
        echo "  3) Batch insert demo data\n\n";
        echo "Your choice: ";

        $selected = trim(fgets(STDIN));
        if ($selected == "1") {
            Yii::$app->runAction('migrate/up', ['migrationPath' => '@vendor/wdmg/yii2-geo/migrations', 'interactive' => true]);
        } else if($selected == "2") {
            Yii::$app->runAction('migrate/down', ['migrationPath' => '@vendor/wdmg/yii2-geo/migrations', 'interactive' => true]);
        } else if($selected == "3") {

            echo $this->ansiFormat("\n\n");

            echo $this->ansiFormat("Insert countries... ", Console::FG_YELLOW);
            $geo_countries = json_decode(file_get_contents(realpath(__DIR__ . '/..') . '/migrations/geo_countries.json'), true);
            foreach ($geo_countries as $country) {
                $country['created_at'] = date("Y-m-d H:i:s");
                $country['updated_at'] = date("Y-m-d H:i:s");
                Yii::$app->db->createCommand()->insert('{{geo_countries}}', $country)->execute();
            }
            echo $this->ansiFormat("Done.\n", Console::FG_GREEN);

            echo $this->ansiFormat("Insert regions... ", Console::FG_YELLOW);
            $geo_regions = json_decode(file_get_contents(realpath(__DIR__ . '/..') . '/migrations/geo_regions.json'), true);
            foreach ($geo_regions as $region) {
                $region['created_at'] = date("Y-m-d H:i:s");
                $region['updated_at'] = date("Y-m-d H:i:s");
                Yii::$app->db->createCommand()->insert('{{geo_regions}}', $region)->execute();
            }
            echo $this->ansiFormat("Done.\n", Console::FG_GREEN);

            echo $this->ansiFormat("Insert cities... ", Console::FG_YELLOW);
            $geo_cities = json_decode(file_get_contents(realpath(__DIR__ . '/..') . '/migrations/geo_cities.json'), true);
            foreach ($geo_cities as $city) {
                $city['created_at'] = date("Y-m-d H:i:s");
                $city['updated_at'] = date("Y-m-d H:i:s");
                Yii::$app->db->createCommand()->insert('{{geo_cities}}', $city)->execute();
            }
            echo $this->ansiFormat("Done.\n", Console::FG_GREEN);

            echo $this->ansiFormat("Insert translations... ", Console::FG_YELLOW);
            $geo_translations = json_decode(file_get_contents(realpath(__DIR__ . '/..') . '/migrations/geo_translations.json'), true);
            foreach ($geo_translations as $translation) {
                $translation['created_at'] = date("Y-m-d H:i:s");
                $translation['updated_at'] = date("Y-m-d H:i:s");
                Yii::$app->db->createCommand()->insert('{{geo_translations}}', $translation)->execute();
            }
            echo $this->ansiFormat("Done.\n\n", Console::FG_GREEN);

            echo $this->ansiFormat("Data inserted successfully.\n\n", Console::FG_GREEN);

        } else {
            echo $this->ansiFormat("Error! Your selection has not been recognized.\n\n", Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        echo "\n";
        return ExitCode::OK;
    }
}
