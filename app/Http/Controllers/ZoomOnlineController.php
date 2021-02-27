<?php

namespace App\Http\Controllers;

use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Parameters\DeleteRecordingsParameters;

class ZoomOnlineController extends Controller
{
    public function create()
    {
        $bbb = new BigBlueButton();
        $isRecordingTrue = true;
        $createMeetingParams = new CreateMeetingParameters('123456', 'demo');
        $createMeetingParams->setAttendeePassword('attendee_password');
        $createMeetingParams->setModeratorPassword('moderator_password');
        $createMeetingParams->setDuration(100);
        $createMeetingParams->setLogoutUrl('lms.cltechpro.com');
        if ($isRecordingTrue) {
            $createMeetingParams->setRecord(true);
            $createMeetingParams->setAllowStartStopRecording(true);
            $createMeetingParams->setAutoStartRecording(true);
        }

        $response = $bbb->createMeeting($createMeetingParams);
        if ($response->getReturnCode() == 'FAILED') {
            return 'Can\'t create room! please contact our administrator.';
        } else {
            // process after room created
        }
    }
    public function join()
    {
        $bbb = new BigBlueButton();
        // $moderator_password for moderator
        $joinMeetingParams = new JoinMeetingParameters('123456', 'attendee', 'attendee_password');
        $joinMeetingParams->setRedirect(true);
        $url = $bbb->getJoinMeetingURL($joinMeetingParams);
        var_dump($url);
        die();
        header('Location:' . $url);
    }
    public function end()
    {
        $bbb = new BigBlueButton();
        $endMeetingParams = new EndMeetingParameters('123456', 'moderator_password');
        $response = $bbb->endMeeting($endMeetingParams);
        var_dump($response);
        die();
    }
    public function info()
    {   
        $bbb = new BigBlueButton();
        $getMeetingInfoParams = new GetMeetingInfoParameters('123456', 'moderator_password');
        $response = $bbb->getMeetingInfo($getMeetingInfoParams);
        if ($response->getReturnCode() == 'FAILED') {
            // meeting not found or already closed
        } else {
            // process $response->getRawXml();
        }
        var_dump($response);
        die();
    }
    public function getAll(){
        $bbb = new BigBlueButton();
        $response = $bbb->getMeetings();
        if ($response->getReturnCode() == 'SUCCESS') {
            foreach ($response->getRawXml()->meetings->meeting as $meeting) {
                var_dump($meeting);
                // process all meeting
            }
        }
        die();
    }
    public function getRecords(){
        $recordingParams = new GetRecordingsParameters();
        $bbb = new BigBlueButton();
        $response = $bbb->getRecordings($recordingParams);

        if ($response->getReturnCode() == 'SUCCESS') {
            foreach ($response->getRawXml()->recordings->recording as $recording) {
                var_dump($recording);
            }
        }
        die();
    }
    public function deleteRecords(){
        $bbb = new BigBlueButton();
        $deleteRecordingsParams= new DeleteRecordingsParameters('7c4a8d09ca3762af61e59520943dc26494f8941b-1613804172247'); // get from "Get Recordings"
        $response = $bbb->deleteRecordings($deleteRecordingsParams);
        var_dump($response);die();
        if ($response->getReturnCode() == 'SUCCESS') {
            // recording deleted
        } else {
            // something wrong
        }
    }
}
