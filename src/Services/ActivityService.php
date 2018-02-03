<?php

namespace App\Services;

class ActivityService {

    public function __construct($eagleApi)
    {
        $this->eagleApi = $eagleApi;
    }


    /**
     * Returns an array of upcoming activities from the club website/API
     * @return [type] [description]
     */
    private function getActivities()
    {
        // Fetch the activity endpoint of the API
        $apiUrl = $this->eagleApi . '/activity';
        $activitiesString = file_get_contents($apiUrl);

        // Decode the response and return
        return json_decode($activitiesString);
    }


    /**
     * Returns an array of activities happening in the next week
     * @return boolean [description]
     */
    public function getThisWeeksActivities()
    {
        // Gets the full list of activities
        $activities = $this->getActivities();

        $until = new \DateTime();
        $until->add(new \DateInterval('P7D'));

        //Loop over the list of activities, and place ones occuring this week into $thisWeeksActivities
        $thisWeeksActivities = [];
        foreach ($activities as $activity) {
            $activityStart = new \DateTime($activity->activityStart);
            if ($activityStart < $until) {
                $thisWeeksActivities[] = $activity;
            } else {
                //Results are returned in order, so we can exit the loop as soon as we find an event that starts more than a week away
                break;
            }
        }

        return $thisWeeksActivities;
    }
}
