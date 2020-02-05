<?php
/**
 * WorktimeController.php - Main Controller
 *
 * Main Controller Worktime Module
 *
 * @category Controller
 * @package Worktime
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Worktime\Filter\Controller;

use Application\Controller\CoreEntityController;
use Application\Model\CoreEntityModel;
use OnePlace\Worktime\Model\Worktime;
use OnePlace\Worktime\Model\WorktimeTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class FilterController extends CoreEntityController {
    /**
     * Worktime Table Object
     *
     * @since 1.0.0
     */
    protected $oTableGateway;

    /**
     * WorktimeController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param WorktimeTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,WorktimeTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'worktime-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    public function filterIndexByState() {
        /**
         * Execute your hook code here
         *
         * optional: return an array to attach data to View
         * otherwise return true
         */

        $oPaginator = $this->oTableGateway->fetchAll(true,['created_by'=>CoreEntityController::$oSession->oUser->getID()]);
        return $oPaginator;
    }
}
