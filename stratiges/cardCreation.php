<?php
namespace stratiges;

trait cardCreation{
  public function cardDetails($obj , $details , $unit){
    foreach($obj as $key => $value){
      if($key == 'id'){
        continue;
      }
    
      if($key === 'details'){
        $obj = json_decode($value , true);
        if(!is_array($details)){
          $this->hasOneDetails($obj , $details , $unit);
        }else{
          $this->hasManyDetails($obj , $details);
        }  
      }else{
          $this->html = $this->html.'<p class="card-text text-center"  style = "line-height: 12px">'. 
                                    $value;
          $this->isPrice($key);
          $this->html .='</p>';
      }
    }
    $this->html .= '</div>' .'</div>' .'</div>' .'</div>' ;    
  }

  public function hasOneDetails($obj , $details , $unit){
    $this->html .='<p class="card-text text-center"  style = "line-height: 12px">'. 
                    $details.' : '. $obj[0][$details].$unit.
                  '</p>';
  }

  public function hasManyDetails($obj , $details){
    $this->html .= '<span class="card-text text-center"  style = "line-height: 12px">'. 
                            '<small>'.'dimension: '.'</small>'.
                          '</span>';
                                    
    for($arrIndex = 0; $arrIndex < count($obj); $arrIndex++){
      for($jsonIndex = 0; $jsonIndex < sizeof($details); $jsonIndex++){
        if(isset($obj[$arrIndex][$details[$jsonIndex]])){
          $this->html .= '<span class="card-text text-center"  style = "line-height: 12px">'.
                            '<small>'. 
                                $obj[$arrIndex][$details[$jsonIndex]];
          if($jsonIndex !== sizeof($this->details) - 1){
            $this->html .= '*'.'</small>'.'</span>';
          }else{
            $this->html .= '</small>'.'</span>';
          }                              
        }
      } 
    }
  }

  public function isPrice($key){
    $key !== 'price'? : $this->html .='$';
  }
}
?>