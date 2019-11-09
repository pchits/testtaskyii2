<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Game;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    /**
     * Send money to user accounts
     * @return int Exit code
     */
    public function actionReward($N = 10)
    {

        $query = Game::find()
            ->where(['status' => 'NEW'])
            ->andWhere(['prise_type' => 'money'])
            ->limit($N)->all();

        echo "Games to reward: " . sizeof($query) . "\n";

        $ids = [];

        foreach ($query as $rows) {
            $ids[] = $rows['id'];

            //SEND REQUEST RO BANK
            // ->
            //HERE

            $game = Game::find()
                ->where(['id' => $rows['id']])
                ->one();
            $game->status = 'DONE';
            $game->save();
        }

        return ExitCode::OK;
    }
}
