<?php

class Jobs
{
    public $boardData;
    public $jobDepartments;
    public $jobVacancy;
    public $jobLocations;

    public function __construct($url)
    {
        $this->getDataBoardsApi($url);
        $this->getDepartments();
        $this->getVacancy();
        $this->getLocations();
    }

    public function getDataBoardsApi($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $responseJobs = json_decode($response, true);

        return $this->boardData = $responseJobs;
    }

    public function getDepartments()
    {
        $boardData = $this->boardData;

        $departments = [];
        foreach ($boardData['departments'] as $department) :
            $department_jobs = $department['jobs'];
            if (!empty($department_jobs)) :
                $departments[] = $department['name'];
            endif;
        endforeach;

        return $this->jobDepartments = $departments;
    }

    public function getVacancy()
    {
        $boardData = $this->boardData;

        $vacancy = [];
        foreach ($boardData['departments'] as $department) :
            foreach ($department['jobs'] as $job):
                $vacancy[] = $job;
            endforeach;
        endforeach;

        return $this->jobVacancy = $vacancy;
    }

    public function getLocations()
    {
        $jobs = $this->jobVacancy;

        $locations = [];
        foreach ($jobs as $job) :
            $locations[] = $job['location']['name'];
        endforeach;
        $location_unique = array_unique($locations);

        return $this->jobLocations = $location_unique;
    }

}