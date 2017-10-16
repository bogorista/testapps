<style>
  @media (max-width: 767px){
  .content-area {
      padding: 0;
  }
  .row.mainnavbar {
    margin-bottom: 0px;
    margin-right: 0px;
  }
}

</style>

<div class="grid">


    <div class="grid__col-sm-12 grid__col-md-12 grid__col--bleed">
      <div class="grid grid--align-content-start">
<?php if($this->user->admin == "1"){ ?> 

        <div class="grid__col-12">
            <div class="tile-base no-padding" > 
             <?php  $attributes = array('class' => '', 'method' => 'POST', 'id' => '_reports');
              echo form_open($form_action, $attributes); ?>
                <div class="grid tile-base__form-heading">
                  <div class="grid__col-md-4">
                          <div class="form-group tt">
                              <label for="reports"><?=$this->lang->line('application_reports');?> </label>
                              <select id="report" name="report" class="formcontrol chosen-select ">
                                    <option value="income"><?=$this->lang->line('application_income_and_expenses');?></option>
                                    <option value="clients" <?php if(isset($report_selected)){ echo "selected";}?>><?=$this->lang->line('application_income_by_client');?></option>          

                              </select>
                          </div>    
                  </div>

                  <div class="grid__col-md-2">
                        <div class="form-group filled">
                              <label for="start"><?=$this->lang->line('application_start_date');?> *</label>
                              <input class="form-control datepicker" name="start" id="start" type="text" value="<?=$stats_start_short;?>" placeholder="<?=$this->lang->line('application_start_date');?>" required/>
                        </div>
                  </div>
                  <div class="grid__col-md-2">
                        <div class="form-group filled">
                              <label for="end"><?=$this->lang->line('application_end_date');?> *</label>
                              <input class="form-control datepicker-linked" name="end" id="end" type="text" value="<?=$stats_end_short;?>" placeholder="<?=$this->lang->line('application_end_date');?>" required/>
                        </div>
                  </div>
                   <div class="grid__col-md-2 grid--align-self-end">
                        
                              <input class="btn btn-primary" name="send" type="submit" value="<?=$this->lang->line('application_apply');?>" placeholder="" required/>
                       
                  </div>
              </div>
              <?php form_close();?>
              <div class="tile-extended-header">
                  <div class="grid tile-extended-header">
                      <div class="grid__col-4">
                          <h5><?=$this->lang->line('application_statistics');?> </h5>
                          <div class="btn-group">
                        <button type="button" class="tile-year-selector dropdown-toggle" data-toggle="dropdown">
                          <?=$stats_start;?> - <?=$stats_end;?>
                        </button>
                        
                  </div>
                      </div>
                      <div class="grid__col-8">
                            <?php if(!isset($report_selected)){ ?>
                            <div class="grid grid--bleed grid--justify-end">
                                <div class="grid__col-md-3 tile-text-right">
                                    <h5><?=$this->lang->line('application_income');?></h5>
                                    <h1><?=display_money($totalIncomeForYear, false);?></h1>
                                </div>
                                <div class="grid__col-md-3 tile-text-right tile-negative">
                                    <h5><?=$this->lang->line('application_expenses');?></h5>
                                    <h1><?=display_money($totalExpenses, false);?></h1>
                                </div>
                                <div class="grid__col-md-3 tile-text-right tile-positive">
                                    <h5><?=$this->lang->line('application_profit');?></h5>
                                    <h1><?=display_money($totalProfit, false);?></h1>
                                </div>
                          </div>
                          <?php } ?>
                      </div>
                      <div class="grid__col-12 grid--align-self-end">
                          <div class="tile-body">
                              <canvas id="tileChart" width="auto" height="80" style="margin-bottom: -11px;"></canvas>
                          </div>
                      </div>
                    </div>
                  </div>   
            </div>
</div> <?php } ?>

        


      </div>
    </div>


</div>


 



<script type="text/javascript">
$(document).ready(function(){

  //chartjs

  var ctx = document.getElementById("tileChart");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [<?=strtoupper($labels)?>],
      datasets: [<?php if($line2 != 0){?>{
        label: "<?=$this->lang->line("application_owed");?>",
        backgroundColor: "rgba(237,85,101,0.6)",
        borderColor: "rgba(237,85,101,1)",
        pointBorderColor: "rgba(0,0,0,0)",
        pointBackgroundColor: "#ffffff",
        pointHoverBackgroundColor: "rgba(237, 85, 101, 0.5)",
        pointHitRadius: 25,
        pointRadius: 1,
        data: [<?=$line2?>],
      },<?php } ?>{
        label: "<?=$this->lang->line("application_received");?>",
        backgroundColor: "rgba(46,204,113,0.6)",
        borderColor: "rgba(46,204,113,1)",
        pointBorderColor: "rgba(0,0,0,0)",
        pointBackgroundColor: "#ffffff",
        pointHoverBackgroundColor: "rgba(79, 193, 233, 1)",
        pointHitRadius: 25,
        pointRadius: 1,
        data: [<?=$line1?>],
      },
      ]
    },
    options: {
      tooltips:{
        xPadding: 10,
        yPadding: 10,
        cornerRadius:2,
        mode: 'label',
        multiKeyBackground: 'rgba(0,0,0,0.2)'
      },
      legend:{
        display: false
      },
      scales: {
         
        yAxes: [{
          display: true,
          gridLines:[{
                      drawOnChartArea: false,
          }],
          ticks: {
                      fontColor: "#A4A5A9",
                      fontFamily: "Open Sans",
                      fontSize: 11,
                      beginAtZero:true,
                      maxTicksLimit:6,
                  }
        }],
        xAxes: [{
          display: true,
          ticks: {
                      fontColor: "#A4A5A9",
                      fontFamily: "Open Sans",
                      fontSize: 11,
                 }
        }]
      }
    }
  });



});
</script>



 