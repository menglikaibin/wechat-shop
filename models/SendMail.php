<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/12/10
 * Time: 11:42
 */
namespace app\models;

use shmilyzxt\queue\base\Job;
use shmilyzxt\queue\base\JobHandler;
use Yii;

class SendMail extends JobHandler
{
    public function handle($job, $data)
    {
        if ($job->getAttempts() > 3) {
            $this->failed($job);
        }
    }

    public function failed($job, $data)
    {

    }
}