<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// models
use App\Models\Accomplishment\AccomplishmentModel;
use App\Models\ActivityLogModel;
use App\Models\ArchivedFileModel;
use App\Models\Attendance\AttendanceModel;
use App\Models\AuthModel;
use App\Models\DeletedFileModel;
use App\Models\Installer\InstallerModel;
use App\Models\Inventory\ItEquipmentModel;
use App\Models\Inventory\OfficeSupplyModel;
use App\Models\NotificationModel;
use App\Models\Portal\AnnouncementModel;
use App\Models\Portal\DownloadModel;
use App\Models\Portal\User\CivilServiceEligibilityModel;
use App\Models\Portal\User\EducationBackgroundModel;
use App\Models\Portal\User\FamilyModel;
use App\Models\Portal\User\UserChildrenModel;
use App\Models\Portal\User\UserModel;
use App\Models\Portal\User\WorkExperienceModel;
use App\Models\Request\ReqItEquipmentModel;
use App\Models\Request\ReqItSupportModel;
use App\Models\Request\ReqLeaveModel;
use App\Models\Request\ReqOfficeSupplyModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;

    /**
     * @return void
     */
    // Declare a private property to hold an instance of all models

    //Auth models
    protected $authObj; //AuthModel

    //Accomplishment models
    protected $accomplishmentObj;//AccomplishmentModel

    //Attendance models
    protected $attendanceObj;//AttendanceModel
    //Installer models
    protected $installerObj;//InstallerModel

    //Inventory models
    protected $itEquipmentObj;//ItEquipmentModel
    protected $officeSupplyObj;//OfficeSupplyModel

    //Portal models
    protected $announcementObj;//AnnouncementModel
    protected $downloadObj;//DownloadModel
        //user models
        protected $userModelObj;  //UserModel
        protected $userFamilyModelObj; //FamilyModel 
        protected $userChildrenModelObj; //UserChildrenModel
        protected $userEducationBackgroundObj; // EducationBackgroundModel
        protected $userCivilServiceEligibilityModelObj; //CivilServiceEligibilityModel
        protected $userWorkExperienceObj; //WorkExperienceModel

    //Rquest models
    protected $reqItEquipmentObj;//ActivityLogModel
    protected $reqOfficeSupplyObj;//ArchivedFileModel
    protected $reqLeaveObj;//DeletedFileModel
    protected $reqItSupportObj;//NotificationModel

    //Other models
    protected $activityLogObj;//ActivityLogModel
    protected $archivedFileObj;//ArchivedFileModel
    protected $deletedFileObj;//DeletedFileModel
    protected $notificationObj;//NotificationModel
    


    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = service('session');

        // Create a new instance for Auth
        $this->authObj = new AuthModel();

        // Create a new instance for Accomplishment
        $this->accomplishmentObj = new AccomplishmentModel();
         // Create a new instance for Attendance
        $this->attendanceObj = new AttendanceModel();
         // Create a new instance for Installer
        $this->installerObj = new InstallerModel();
         // Create a new instance for Inventory
        $this->itEquipmentObj = new ItEquipmentModel();
        $this->officeSupplyObj = new OfficeSupplyModel();

         // Create a new instance for Portal
        $this->announcementObj = new AnnouncementModel();
        $this->downloadObj = new DownloadModel();
            // Create a new instance for User
            $this->userModelObj = new UserModel();
            $this->userFamilyModelObj = new FamilyModel();
            $this->userChildrenModelObj = new UserChildrenModel();
            $this->userEducationBackgroundObj = new EducationBackgroundModel();
            $this->userCivilServiceEligibilityModelObj = new CivilServiceEligibilityModel();
            $this->userWorkExperienceObj = new WorkExperienceModel();

        // Create a new instance for Request models
        $this->reqItEquipmentObj = new ReqItEquipmentModel();
        $this->reqOfficeSupplyObj = new ReqOfficeSupplyModel();
        $this->reqLeaveObj = new ReqLeaveModel();
        $this->reqItSupportObj = new ReqItSupportModel();

        // Create a new instance for Other models
        $this->activityLogObj = new ActivityLogModel();
        $this->archivedFileObj = new ArchivedFileModel();
        $this->deletedFileObj = new DeletedFileModel();
        $this->notificationObj = new NotificationModel();
    }
}
