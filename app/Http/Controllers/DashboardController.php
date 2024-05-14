<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AnimalModel;
use App\Models\MilkingModel;
use Illuminate\Http\Request;
use App\Models\PregnancyModel;
use App\Models\TreatmentModel;
use App\Models\VaccinationModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['headerTitle'] = 'Dashboard';

        if(Auth::user()->role == 'Admin'){

            date_default_timezone_set('Asia/Colombo');
            $todayDate = Carbon::now('Asia/Colombo');
            
            $today = $todayDate->format('Y-m-d');
            $firstDayofWeek = Carbon::now('Asia/Colombo')->startOfWeek()->format('Y-m-d');
            $lastDayofWeek = Carbon::now('Asia/Colombo')->endOfWeek()->format('Y-m-d');


            //Fetching User Info
            $data['adminCount'] = User::getUserRec('Admin');
            $data['managerCount'] = User::getUserRec('Manager');
            $data['officeStaffCount'] = User::getUserRec('Office Staff');
            $data['medicalStaffCount'] = User::getUserRec('Medical Staff');
            $data['filedStaffCount'] = User::getUserRec('Field Staff');
            $data['storesStaffCount'] = User::getUserRec('Stores Staff');

            //Fetching Animal Info
            $data['stallCount'] = AnimalModel::getStallCount();
            $data['totalBullCount'] = AnimalModel::getAnimalCount('Male');
            $data['totalCowCount'] = AnimalModel::getAnimalCount('Female');
            $data['totalMilkingCowCount'] = AnimalModel::getMilkingAnimalCount();
            $data['totalNonMilkingCowCount'] = AnimalModel::getNonMilkingAnimalCount();
            $data['totalPregCowCount'] = AnimalModel::getPregAnimalCount();
            $data['newBirthCount'] = AnimalModel::getNewBirhtCount($firstDayofWeek);

            //Fetching Milking Info
            $data['todayMorMilk'] = MilkingModel::getMorMilkVol($today);
            $data['todayEveMilk'] = MilkingModel::getEveMilkVol($today);
            $data['weekMorMilk'] = MilkingModel::getMorMilkVol($firstDayofWeek);
            $data['weekEveMilk'] = MilkingModel::getEveMilkVol($firstDayofWeek);

            //Fetching Pregnancy Info
            $data['delDueCount'] = PregnancyModel::getDelDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Vaccination Info
            $data['vacDueCount'] = VaccinationModel::getVacDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Treatment Info
            $data['pendingTreatmentCount'] = TreatmentModel::getPendingTreatCount();


            //Fetching data for Chart
            $startDateofChart = Carbon::now('Asia/Colombo')
                                        ->subDay(10);

                for ($i = 0; $i < 10; $i++) {
                    // Add each date to the array
                    $lastTenDates[] = $startDateofChart->addDay()->toDateString();

                }

                foreach ($lastTenDates as $item){

                    $getMorMilkVol = MilkingModel::getMorMilkVolforDay($item);
                    $getEveMilkVol = MilkingModel::getEveMilkVolforDay($item);

                    $totalVol[] = $getMorMilkVol + $getEveMilkVol;
                    
                }

            return view('admin.dashboard', $data)->with('labels', $lastTenDates)->with('chartData', $totalVol);

        }

        elseif(Auth::user()->role == 'Manager'){

            date_default_timezone_set('Asia/Colombo');
            $todayDate = Carbon::now('Asia/Colombo');
            
            $today = $todayDate->format('Y-m-d');
            $firstDayofWeek = Carbon::now('Asia/Colombo')->startOfWeek()->format('Y-m-d');
            $lastDayofWeek = Carbon::now('Asia/Colombo')->endOfWeek()->format('Y-m-d');


            //Fetching User Info
            $data['officeStaffCount'] = User::getUserRec('Office Staff');
            $data['medicalStaffCount'] = User::getUserRec('Medical Staff');
            $data['filedStaffCount'] = User::getUserRec('Field Staff');
            $data['storesStaffCount'] = User::getUserRec('Stores Staff');

            //Fetching Animal Info
            $data['stallCount'] = AnimalModel::getStallCount();
            $data['totalBullCount'] = AnimalModel::getAnimalCount('Male');
            $data['totalCowCount'] = AnimalModel::getAnimalCount('Female');
            $data['totalMilkingCowCount'] = AnimalModel::getMilkingAnimalCount();
            $data['totalNonMilkingCowCount'] = AnimalModel::getNonMilkingAnimalCount();
            $data['totalPregCowCount'] = AnimalModel::getPregAnimalCount();
            $data['newBirthCount'] = AnimalModel::getNewBirhtCount($firstDayofWeek);

            //Fetching Milking Info
            $data['todayMorMilk'] = MilkingModel::getMorMilkVol($today);
            $data['todayEveMilk'] = MilkingModel::getEveMilkVol($today);
            $data['weekMorMilk'] = MilkingModel::getMorMilkVol($firstDayofWeek);
            $data['weekEveMilk'] = MilkingModel::getEveMilkVol($firstDayofWeek);

            //Fetching Pregnancy Info
            $data['delDueCount'] = PregnancyModel::getDelDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Vaccination Info
            $data['vacDueCount'] = VaccinationModel::getVacDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Treatment Info
            $data['pendingTreatmentCount'] = TreatmentModel::getPendingTreatCount();


            //Fetching data for Chart
            $startDateofChart = Carbon::now('Asia/Colombo')
                                        ->subDay(10);

                for ($i = 0; $i < 10; $i++) {
                    // Add each date to the array
                    $lastTenDates[] = $startDateofChart->addDay()->toDateString();

                }

                foreach ($lastTenDates as $item){

                    $getMorMilkVol = MilkingModel::getMorMilkVolforDay($item);
                    $getEveMilkVol = MilkingModel::getEveMilkVolforDay($item);

                    $totalVol[] = $getMorMilkVol + $getEveMilkVol;
                    
                }

            return view('manager.dashboard', $data)->with('labels', $lastTenDates)->with('chartData', $totalVol);

        }


        elseif(Auth::user()->role == 'Office Staff'){

            date_default_timezone_set('Asia/Colombo');
            $todayDate = Carbon::now('Asia/Colombo');
            
            $today = $todayDate->format('Y-m-d');
            $firstDayofWeek = Carbon::now('Asia/Colombo')->startOfWeek()->format('Y-m-d');
            $lastDayofWeek = Carbon::now('Asia/Colombo')->endOfWeek()->format('Y-m-d');

            //Fetching Animal Info
            $data['stallCount'] = AnimalModel::getStallCount();
            $data['totalBullCount'] = AnimalModel::getAnimalCount('Male');
            $data['totalCowCount'] = AnimalModel::getAnimalCount('Female');
            $data['totalMilkingCowCount'] = AnimalModel::getMilkingAnimalCount();
            $data['totalNonMilkingCowCount'] = AnimalModel::getNonMilkingAnimalCount();
            $data['totalPregCowCount'] = AnimalModel::getPregAnimalCount();
            $data['newBirthCount'] = AnimalModel::getNewBirhtCount($firstDayofWeek);

            //Fetching Milking Info
            $data['todayMorMilk'] = MilkingModel::getMorMilkVol($today);
            $data['todayEveMilk'] = MilkingModel::getEveMilkVol($today);
            $data['weekMorMilk'] = MilkingModel::getMorMilkVol($firstDayofWeek);
            $data['weekEveMilk'] = MilkingModel::getEveMilkVol($firstDayofWeek);

            //Fetching Pregnancy Info
            $data['delDueCount'] = PregnancyModel::getDelDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Vaccination Info
            $data['vacDueCount'] = VaccinationModel::getVacDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Treatment Info
            $data['pendingTreatmentCount'] = TreatmentModel::getPendingTreatCount();


            //Fetching data for Chart
            $startDateofChart = Carbon::now('Asia/Colombo')
                                        ->subDay(10);

                for ($i = 0; $i < 10; $i++) {
                    // Add each date to the array
                    $lastTenDates[] = $startDateofChart->addDay()->toDateString();

                }

                foreach ($lastTenDates as $item){

                    $getMorMilkVol = MilkingModel::getMorMilkVolforDay($item);
                    $getEveMilkVol = MilkingModel::getEveMilkVolforDay($item);

                    $totalVol[] = $getMorMilkVol + $getEveMilkVol;
                    
                }

            return view('officeStaff.dashboard', $data)->with('labels', $lastTenDates)->with('chartData', $totalVol);
        }


        elseif(Auth::user()->role == 'Medical Staff'){

            date_default_timezone_set('Asia/Colombo');
            $todayDate = Carbon::now('Asia/Colombo');
            
            $today = $todayDate->format('Y-m-d');
            $firstDayofWeek = Carbon::now('Asia/Colombo')->startOfWeek()->format('Y-m-d');
            $lastDayofWeek = Carbon::now('Asia/Colombo')->endOfWeek()->format('Y-m-d');

            //Fetching Animal Info
            $data['stallCount'] = AnimalModel::getStallCount();
            $data['totalBullCount'] = AnimalModel::getAnimalCount('Male');
            $data['totalCowCount'] = AnimalModel::getAnimalCount('Female');
            $data['totalMilkingCowCount'] = AnimalModel::getMilkingAnimalCount();
            $data['totalNonMilkingCowCount'] = AnimalModel::getNonMilkingAnimalCount();
            $data['totalPregCowCount'] = AnimalModel::getPregAnimalCount();
            $data['newBirthCount'] = AnimalModel::getNewBirhtCount($firstDayofWeek);

            //Fetching Milking Info
            $data['todayMorMilk'] = MilkingModel::getMorMilkVol($today);
            $data['todayEveMilk'] = MilkingModel::getEveMilkVol($today);
            $data['weekMorMilk'] = MilkingModel::getMorMilkVol($firstDayofWeek);
            $data['weekEveMilk'] = MilkingModel::getEveMilkVol($firstDayofWeek);

            //Fetching Pregnancy Info
            $data['delDueCount'] = PregnancyModel::getDelDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Vaccination Info
            $data['vacDueCount'] = VaccinationModel::getVacDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Treatment Info
            $data['pendingTreatmentCount'] = TreatmentModel::getPendingTreatCount();


            //Fetching data for Chart
            $startDateofChart = Carbon::now('Asia/Colombo')
                                        ->subDay(10);

                for ($i = 0; $i < 10; $i++) {
                    // Add each date to the array
                    $lastTenDates[] = $startDateofChart->addDay()->toDateString();

                }

                foreach ($lastTenDates as $item){

                    $getMorMilkVol = MilkingModel::getMorMilkVolforDay($item);
                    $getEveMilkVol = MilkingModel::getEveMilkVolforDay($item);

                    $totalVol[] = $getMorMilkVol + $getEveMilkVol;
                    
                }

            return view('medicalStaff.dashboard', $data)->with('labels', $lastTenDates)->with('chartData', $totalVol);
        }


        elseif(Auth::user()->role == 'Field Staff'){

            date_default_timezone_set('Asia/Colombo');
            $todayDate = Carbon::now('Asia/Colombo');
            
            $today = $todayDate->format('Y-m-d');
            $firstDayofWeek = Carbon::now('Asia/Colombo')->startOfWeek()->format('Y-m-d');
            $lastDayofWeek = Carbon::now('Asia/Colombo')->endOfWeek()->format('Y-m-d');

            //Fetching Animal Info
            $data['stallCount'] = AnimalModel::getStallCount();
            $data['totalBullCount'] = AnimalModel::getAnimalCount('Male');
            $data['totalCowCount'] = AnimalModel::getAnimalCount('Female');
            $data['totalMilkingCowCount'] = AnimalModel::getMilkingAnimalCount();
            $data['totalNonMilkingCowCount'] = AnimalModel::getNonMilkingAnimalCount();
            $data['totalPregCowCount'] = AnimalModel::getPregAnimalCount();
            $data['newBirthCount'] = AnimalModel::getNewBirhtCount($firstDayofWeek);

            //Fetching Milking Info
            $data['todayMorMilk'] = MilkingModel::getMorMilkVol($today);
            $data['todayEveMilk'] = MilkingModel::getEveMilkVol($today);
            $data['weekMorMilk'] = MilkingModel::getMorMilkVol($firstDayofWeek);
            $data['weekEveMilk'] = MilkingModel::getEveMilkVol($firstDayofWeek);

            //Fetching Pregnancy Info
            $data['delDueCount'] = PregnancyModel::getDelDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Vaccination Info
            $data['vacDueCount'] = VaccinationModel::getVacDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Treatment Info
            $data['pendingTreatmentCount'] = TreatmentModel::getPendingTreatCount();


            //Fetching data for Chart
            $startDateofChart = Carbon::now('Asia/Colombo')
                                        ->subDay(10);

                for ($i = 0; $i < 10; $i++) {
                    // Add each date to the array
                    $lastTenDates[] = $startDateofChart->addDay()->toDateString();

                }

                foreach ($lastTenDates as $item){

                    $getMorMilkVol = MilkingModel::getMorMilkVolforDay($item);
                    $getEveMilkVol = MilkingModel::getEveMilkVolforDay($item);

                    $totalVol[] = $getMorMilkVol + $getEveMilkVol;
                    
                }

            return view('fieldStaff.dashboard', $data)->with('labels', $lastTenDates)->with('chartData', $totalVol);
        }


        elseif(Auth::user()->role == 'Stores Staff'){

            date_default_timezone_set('Asia/Colombo');
            $todayDate = Carbon::now('Asia/Colombo');
            
            $today = $todayDate->format('Y-m-d');
            $firstDayofWeek = Carbon::now('Asia/Colombo')->startOfWeek()->format('Y-m-d');
            $lastDayofWeek = Carbon::now('Asia/Colombo')->endOfWeek()->format('Y-m-d');

            //Fetching Animal Info
            $data['stallCount'] = AnimalModel::getStallCount();
            $data['totalBullCount'] = AnimalModel::getAnimalCount('Male');
            $data['totalCowCount'] = AnimalModel::getAnimalCount('Female');
            $data['totalMilkingCowCount'] = AnimalModel::getMilkingAnimalCount();
            $data['totalNonMilkingCowCount'] = AnimalModel::getNonMilkingAnimalCount();
            $data['totalPregCowCount'] = AnimalModel::getPregAnimalCount();
            $data['newBirthCount'] = AnimalModel::getNewBirhtCount($firstDayofWeek);

            //Fetching Milking Info
            $data['todayMorMilk'] = MilkingModel::getMorMilkVol($today);
            $data['todayEveMilk'] = MilkingModel::getEveMilkVol($today);
            $data['weekMorMilk'] = MilkingModel::getMorMilkVol($firstDayofWeek);
            $data['weekEveMilk'] = MilkingModel::getEveMilkVol($firstDayofWeek);

            //Fetching Pregnancy Info
            $data['delDueCount'] = PregnancyModel::getDelDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Vaccination Info
            $data['vacDueCount'] = VaccinationModel::getVacDueCount($firstDayofWeek, $lastDayofWeek);

            //Fetching Treatment Info
            $data['pendingTreatmentCount'] = TreatmentModel::getPendingTreatCount();


            //Fetching data for Chart
            $startDateofChart = Carbon::now('Asia/Colombo')
                                        ->subDay(10);

                for ($i = 0; $i < 10; $i++) {
                    // Add each date to the array
                    $lastTenDates[] = $startDateofChart->addDay()->toDateString();

                }

                foreach ($lastTenDates as $item){

                    $getMorMilkVol = MilkingModel::getMorMilkVolforDay($item);
                    $getEveMilkVol = MilkingModel::getEveMilkVolforDay($item);

                    $totalVol[] = $getMorMilkVol + $getEveMilkVol;
                    
                }

            return view('storesStaff.dashboard', $data)->with('labels', $lastTenDates)->with('chartData', $totalVol);
        }

    }

}
