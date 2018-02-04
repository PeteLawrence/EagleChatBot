<?php

namespace App\Services;

class BotService {

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }


    /**
     * Generates a response to being asked 'Hello'
     * @return [type] [description]
     */
    public function handleHello()
    {
        $responses = ['Hello', 'Hi', 'Hi there'];

        return $responses[array_rand($responses)];
    }


    /**
     * Generates a response to being asked about club nights
     * @return [type] [description]
     */
    public function handleClubNights()
    {
        return 'Club nights are on Wednesdays';
    }


    /**
     * Generates a response to being asked about enrolment
     * @return [type] [description]
     */
    public function handleEnrolment()
    {
        return 'Enrolment is on the first Wednesday of each month';
    }


    /**
     * Generates a response to being asked about insurance
     * @return [type] [description]
     */
    public function handleInsurance()
    {
        return 'If you are a British Canoeing member your insurance is already provided.  If not, you can purchase insurance via the club - Adults: £3, Youth: £2';
    }


    /**
     * Generates a response to being asked about membership
     * @return [type] [description]
     */
    public function handleMembership()
    {
        return 'Membership runs from April-April.  Adult membership is £80, and youth membership is £45.  Discounts are available for families and volunteers.  For more information see https://www.eaglecanoeclub.co.uk/howtojoin';
    }


    /**
     * Generates a response to being asked about this weeks activities
     * @return boolean [description]
     */
    public function handleThisWeeksActivities()
    {
        // Gets an array of this weeks activities
        $thisWeeksActivities = $this->activityService->getThisWeeksActivities();

        if (sizeof($thisWeeksActivities) == 0) {
            return 'Sorry, there\'s nothing happening this week';
        } else {
            $message = 'This week at Eagle Canoe Club there is:  ';

            foreach ($thisWeeksActivities as $activity) {
                $activityStart = new \DateTime($activity->activityStart);
                $activityStartDay = $activityStart->format('l');
                $message .= sprintf('%s on %s, ', $activity->name, $activityStartDay);
            }

            return $message;
        }
    }

}
