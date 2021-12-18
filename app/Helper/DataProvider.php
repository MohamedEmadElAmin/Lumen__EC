<?php


namespace App\Helper;


class DataProvider extends ProviderMaps
{
    private string $id;
    private string $currency;
    private float $amount;
    private string $date;
    private string $status;
    private string $phone;

    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;
        $this->startFormatting();
    }

    private function startFormatting(): void
    {
        foreach ($this->rawData as $key => $rawDatum)
        {
            if(in_array($key , $this->idMapping))
                $this->id = (string)$rawDatum;
            else if(in_array($key , $this->currencyMapping))
                $this->currency = (string)$rawDatum;
            else if(in_array($key , $this->amountMapping))
                $this->amount = (float)$rawDatum;
            else if(in_array($key , $this->dateMapping))
                $this->date = (string)$rawDatum;
            else if(in_array($key , $this->statusMapping))
            {
                if(in_array($rawDatum , $this->paidStatusMapping))
                    $this->status = "paid";
                else if(in_array($rawDatum , $this->pendingStatusMapping))
                    $this->status = "pending";
                else if(in_array($rawDatum , $this->rejectStatusMapping))
                    $this->status = "reject";
            }
            else if(in_array($key , $this->phoneMapping))
                $this->phone = (string)$rawDatum;
        }
    }

    public function toArray(): array
    {
        return ["id" => $this->id , "currency" => $this->getCurrency() ,
            "amount" => $this->getAmount() , "phone" =>$this->getPhone() ,
            "status" => $this->getStatus() , "date" => $this->getDate()];
    }


    /**
     * @return mixed
     */
    public function getRawData()
    {
        return $this->rawData;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }
    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }
    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
