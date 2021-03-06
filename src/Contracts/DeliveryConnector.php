<?php

namespace PickPointSdk\Contracts;

use PickPointSdk\Components\CourierCall;
use PickPointSdk\Components\State;
use PickPointSdk\Components\Invoice;
use PickPointSdk\Components\PackageSize;
use PickPointSdk\Components\TariffPrice;
use PickPointSdk\Components\SenderDestination;
use PickPointSdk\Components\ReceiverDestination;

interface DeliveryConnector
{
    /**
     * get delivery points
     * @return mixed
     */
    public function getPoints();

    /**
     * Returns invoice data and create shipment/order in delivery service
     * @param Invoice $invoice
     * @return mixed
     */
    public function createShipment(Invoice $invoice);

    /**
     * @param Invoice $invoice
     * @return mixed
     */
    public function createShipmentWithInvoice(Invoice $invoice): Invoice;

    /**
     * Returns current delivery status
     * @param string $invoiceNumber
     * @param string $orderNumber
     * @return mixed
     */
    public function getState(string $invoiceNumber, string $orderNumber = ''): State;

    /**
     * @param string $invoiceNumber
     * @param string $senderCode
     * @return mixed
     */
    public function cancelInvoice(string $invoiceNumber = '', string $senderCode = '');

    /**
     * @param ReceiverDestination $receiverDestination
     * @param SenderDestination|null $senderDestination
     * @param PackageSize|null $packageSize
     * @return mixed
     */
    public function calculatePrices(ReceiverDestination $receiverDestination, SenderDestination $senderDestination = null, PackageSize $packageSize = null): array;

    /**
     * @param ReceiverDestination $receiverDestination
     * @param string $tariffType
     * @param SenderDestination|null $senderDestination
     * @param PackageSize|null $packageSize
     * @return TariffPrice
     */
    public function calculateObjectedPrices(ReceiverDestination $receiverDestination, string $tariffType = 'Standard', SenderDestination $senderDestination = null, PackageSize $packageSize = null): TariffPrice;

    /**
     * Marks on packages
     * @param array $invoiceNumbers
     * @return mixed
     */
    public function printLabel(array $invoiceNumbers): string;

    /**
     * Create Reestr
     * @param array $invoiceNumbers
     * @return mixed
     */
    public function makeReceipt(array $invoiceNumbers): array;

    /**
     * Creates reestr and returns pdf byte code
     * @param array $invoiceNumbers
     * @return mixed
     */
    public function makeReceiptAndPrint(array $invoiceNumbers): string;

    /**
     * Print reestr/receipt
     * @param string $identifier
     * @return mixed
     */
    public function printReceipt(string $identifier): string;

    /**
     * @param string $invoiceNumber
     * @return mixed
     */
    public function removeInvoiceFromReceipt(string $invoiceNumber);

    /**
     * Returns all statuses
     * @return array
     */
    public function getStates(): array;

    /**
     * Return all invoices
     * @param $dateFrom
     * @param $dateTo
     * @param string $status
     * @param string $postageType
     * @return mixed
     */
    public function getInvoicesByDateRange($dateFrom, $dateTo, $status = null, $postageType = null);

    /**
     * @param CourierCall $courierCall
     * @return mixed
     */
    public function callCourier(CourierCall $courierCall);

    /**
     * @param string $callOrderNumber
     * @return mixed
     */
    public function cancelCourierCall(string $callOrderNumber);

    /**
     * @param string $invoiceNumber
     * @param string $shopOrderNumber
     * @return mixed
     */
    public function shipmentInfo(string $invoiceNumber, string $shopOrderNumber);

    /**
     * @param string $invoiceNumber
     * @return mixed
     */
    public function findReestrNumberByInvoice(string $invoiceNumber);

    /**
     * @param array $invoices
     * @return mixed
     */
    public function getInvoicesTrackHistory(array $invoiceNumbers);

    /**
     * @param string $invoiceNumber
     * @return mixed
     */
    public function getInvoiceStatesTrackHistory(string $invoiceNumber);


    /**
     * @param Invoice $invoiceNumber
     * @return mixed
     */
    public function updateShipment(Invoice $invoiceNumber);

    /**
     * @param string $barCode
     * @return PackageSize
     */
    public function getPackageInfo(string $barCode) : PackageSize;

}