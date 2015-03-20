<?php
namespace Fortifi\Sdk\Models\Affiliate;

use Fortifi\FortifiApi\Affiliate\Endpoints\AffiliatePaycheckEndpoint;
use Fortifi\FortifiApi\Affiliate\Payloads\Paychecks\ListPaychecksPayload;
use Fortifi\FortifiApi\Affiliate\Payloads\Paychecks\MarkPaycheckPaidPayload;
use Fortifi\FortifiApi\Affiliate\Responses\Paychecks\AffiliatePaycheckResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Paychecks\AffiliatePaychecksResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Paychecks\AffiliatePaycheckTransactionsResponse;
use Fortifi\FortifiApi\Affiliate\Responses\Paychecks\PrintPaycheckResponse;
use Fortifi\FortifiApi\Foundation\Payloads\FidPayload;
use Fortifi\FortifiApi\Foundation\Payloads\FidsPayload;
use Fortifi\FortifiApi\Foundation\Responses\BoolResponse;
use Fortifi\Sdk\Models\Api\FortifiApiModel;

class AffiliatePaycheckModel extends FortifiApiModel
{
  /**
   * @param string $affiliateFid
   * @param string $paymentService
   * @param string $affiliateManager
   * @param string $paycheckState
   *
   * @return AffiliatePaychecksResponse
   */
  public function all(
    $affiliateFid = null, $paymentService = null, $affiliateManager = null,
    $paycheckState = null
  )
  {
    $payload = new ListPaychecksPayload();
    $payload->fid = $affiliateFid;
    $payload->paymentService = $paymentService;
    $payload->affiliateManager = $affiliateManager;
    $payload->paycheckState = $paycheckState;

    $ep = AffiliatePaycheckEndpoint::bound($this->getApi());
    return $ep->all($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliatePaycheckResponse
   */
  public function retrieve($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliatePaycheckEndpoint::bound($this->getApi());
    return $ep->retrieve($payload)->get();
  }

  /**
   * @param string $paycheckFid
   *
   * @return BoolResponse
   */
  public function approve($paycheckFid)
  {
    $payload = new FidPayload();
    $payload->fid = $paycheckFid;

    $ep = AffiliatePaycheckEndpoint::bound($this->getApi());
    return $ep->approve($payload)->get();
  }

  /**
   * @param string[] $fids
   *
   * @return BoolResponse
   */
  public function bulkApprove(array $fids)
  {
    $payload = new FidsPayload($fids);
    $ep = AffiliatePaycheckEndpoint::bound($this->getApi());
    return $ep->bulkApprove($payload)->get();
  }

  /**
   * @param string $paycheckFid
   * @param int    $paymentDate
   * @param string $paymentInfo
   * @param string $paymentId
   *
   * @return BoolResponse
   */
  public function markPaid(
    $paycheckFid, $paymentDate, $paymentInfo = null, $paymentId = null
  )
  {
    $payload = new MarkPaycheckPaidPayload();
    $payload->fid = $paycheckFid;
    $payload->paymentInfo = $paymentInfo;
    $payload->paymentDate = $paymentDate;
    $payload->paymentId = $paymentId;

    $ep = AffiliatePaycheckEndpoint::bound($this->getApi());
    return $ep->markPaid($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return PrintPaycheckResponse
   */
  public function pdf($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliatePaycheckEndpoint::bound($this->getApi());
    return $ep->pdf($payload)->get();
  }

  /**
   * @param string $fid
   *
   * @return AffiliatePaycheckTransactionsResponse
   */
  public function transactions($fid)
  {
    $payload = new FidPayload();
    $payload->fid = $fid;

    $ep = AffiliatePaycheckEndpoint::bound($this->getApi());
    return $ep->transactions($payload)->get();
  }
}