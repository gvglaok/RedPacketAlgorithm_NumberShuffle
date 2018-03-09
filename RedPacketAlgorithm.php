<?php

class RedPacketAlgorithm
{
  public function rpa($total=1,$number=13)
    {
        bcscale(2);
        //min
        $baseNumber = bcmul($number,2,0);
        $min = bcdiv($total,$baseNumber);
        $minInt = bcdiv($total,$baseNumber)*100;

        //average
        $pj = bcdiv($total,$number);
        $maxInt = bcdiv($total,$number)*100;
        
        if(bccomp($pj,0.01) <=0)
        {
            return "number small";
        }

        //Numerical jitter range $min - $pj
        for ($i=0; $i < $number; $i++) { 
            $random = bcdiv(random_int($minInt,$maxInt),100);
            $randomNumber[] = $random; 

            $rp[] = bcadd($pj,$random);
        }
        
        for ($i=0; $i <$number ; $i++) { 
            $rp[$i] = bcsub($rp[$i],$randomNumber[$number-$i-1]);
        }

        $sum=0;
        for ($i=0; $i <$number ; $i++) { 
            $sum = bcadd($sum,$rp[$i]);
        }

        $last = bcsub($total,$sum);
        $rp[0]= bcadd($rp[0],$last);

        //$rp = collect($rp)->shuffle();
        // echo $rp->sum();
        //dd($rp);

        return $rp;

    }
}
