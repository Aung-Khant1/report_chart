@extends('master')

@section('title')
    <h3> Charts </h3>
@endsection

@section('nav')
    SMS API / Charts
@endsection

@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-header">
            
            <h4><i class="fas fa-chart-bar mr-1"></i> <span class="text-secondary">|</span> Filter <hr></h4> 
            <div class="col-md-12 mb-5">
                <div class="row mt-3 mb-4">
                    <div class="form-check ml-4 mr-4">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                        <label class="form-check-label ml-1" for="flexRadioDefault1">
                          Daily
                        </label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                        <label class="form-check-label ml-1" for="flexRadioDefault4">
                          Yearly
                        </label>
                    </div>
                </div>
                <div id="datesearch">
                    <div class="form-group col-md-12 my-4">
                        <div class="row col-md-12 mb-3">
                            <label for="fromdate" class="col-md-3">From :</label>
                            <input type="date" name="" id="fromdate" class="col-md-8 form-control fromdate">
                        </div>
                        <div class="row col-md-12">
                            <label for="todate" class="col-md-3">To :</label>
                            <input type="date" name="" id="todate" class="col-md-8 form-control todate">
                        </div>
                    </div>
                    <div class="offset-md-3 mb-3">
                        <button class="btn btn-primary btn-sm mr-2" onclick="dssearchwork()">Search</button>
                        <button class="btn btn-success btn-sm">Download</button>
                    </div>
                </div>

                <div id="yearsearch">
                    <div class="form-group col-md-12 my-4">
                        <div class="row col-md-12 mb-3">
                            <label for="ysdate" class="col-md-3">Years :<br><small>(This program is started from 2020-08-01)</small> </label>
                            <input type="number" name="" id="ysdate" class="col-md-6 form-control ysdatework" placeholder="2020">
                        </div>
                        
                    </div>
                    <div class="offset-md-3 mb-3">
                        <button class="btn btn-primary btn-sm mr-2 scrolleff1" onclick="yssearchwork()">Search</button>
                        <button class="btn btn-success btn-sm">Download</button>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6" style="border-right: 2px solid #eee;">
                    
                    <div class="card-header mb-3">
                        
                        <h4><i class="fas fa-chart-pie mr-1"></i>Yesterday</h4>
                    </div>
                    <canvas id="myPieChart" width="100%" height="50"></canvas>
                       
                </div>
                <div class="col-md-6" style="border-right: 2px solid #eee;">
                    
                    <div class="card-header mb-3 row">
                        <div class="col-md-6"><h4 class="scrolleffto1"><i class="fas fa-chart-pie mr-1"></i>Yearly</h4></div>
                        {{-- <a href="{{url('yearlyreport')}}" class="btn btn-primary btn-small">Download</a> --}}
                        <button class="offset-md-3 col-md-3 btn btn-primary btn-sm" onclick="ysdownload()">Download</button>
                        
                    </div>
                    <canvas id="myDonutChart" width="100%" height="50"></canvas>
                </div>
            </div>
            
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <h4 class="card-header mb-4"><i class="far fa-calendar-alt"></i> &nbsp;Monthly</h4>
                <canvas id="myBarChart" width="100%" height="40"></canvas>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="col-md-12">
                    <h4 class="card-header mb-4"><i class="far fa-calendar-alt"></i> &nbsp;For Weekly Report</h4>
                    <canvas id="myAreaChart" width="100%" height="40"></canvas>
                </div>
                <div class="col-md-12">

                </div>
            </div>
        </div>

       
    </div>
</div>

@endsection

@section('js')
    <script>
        
        $(document).ready(function () {
            $('#datesearch').show();
            $('#yearsearch').hide();
            $('#flexRadioDefault1').click(function (e) { 
                
                $('#datesearch').toggle();
                $('#yearsearch').hide();
            });
            
            $('#flexRadioDefault4').click(function (e) { 
                
                $('#datesearch').hide();
                $('#yearsearch').toggle();
            });
        });  
        
        var yesterday = {!!json_encode($yesterday)!!}
        var thisyear = {!!json_encode($thisyear)!!}
        var thisyearlabels = [];
        var thisyeardatas = [];
        thisyear.label.forEach((v,i) => {
            thisyearlabels.push(thisyear.label[i]);
            thisyeardatas.push(thisyear.data[i]);
        })
        // console.log(yesterday.label[0]);

        var monthlyreportpermonthtelenordirect = {!!json_encode($monthlyreportpermonthtelenordirect)!!}
        var monthlyreportpermonthotherapis = {!!json_encode($monthlyreportpermonthotherapis)!!}
        var monthlyreportpermonthotherapislabel = {!!json_encode($monthlyreportpermonthotherapislabel)!!}
        
        var monthlyreportpermonthtelenordirectdata = [];
        var monthlyreportpermonthotherapisdata = [];
        monthlyreportpermonthtelenordirect.forEach((v,i) => {
            monthlyreportpermonthtelenordirectdata.push(monthlyreportpermonthtelenordirect[i].total);
            monthlyreportpermonthotherapisdata.push(monthlyreportpermonthotherapis[i].total);
        });

        // console.log(monthlyreportpermonthtelenordirectdata);

        var dailyreporttelenordirect = {!!json_encode($dailyreporttelenordirect)!!};
        var dailyreportotherapi = {!!json_encode($dailyreportotherapi)!!};

        var dailyreportdatedata = [];
        var dailyreporttelenordirectdata = [];
        var dailyreportotherapidata = [];
        dailyreporttelenordirect.forEach((v,i) => {
            dailyreporttelenordirectdata.push(dailyreporttelenordirect[i].sms_count);
            dailyreportotherapidata.push(dailyreportotherapi[i].sms_count);
            dailyreportdatedata.push(dailyreporttelenordirect[i].counted_date)
        });
        // console.log(dailyreporttelenordirectdata,dailyreportotherapidata)


    </script>
    <script src="{{asset('js/apicharts/chart-bar-demo.js')}}"></script>
    <script src="{{asset('js/apicharts/chart-pie-demo.js')}}"></script>
    <script src="{{asset('js/apicharts/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/apicharts/chart-donut.js')}}"></script>

    <script>
        function yssearchwork() {
            var ysdateworks = document.querySelector(".ysdatework").value;
            if (ysdateworks > '2019') {
                // use axios( write api route )
                return axios.post('/api/ysearch', { searchdate: ysdateworks })
                    .then(response => {
                        // console.log(response.data.searchmonthly.label);
                        // console.log(response.data.searchmonthly.telenor);
                        // console.log(response.data.searchmonthly.other);
                        if (response.data.searchyear.data.length != 0) {
                            this.thisyearlabels = response.data.searchyear.label;
                            this.thisyeardatas = response.data.searchyear.data;
                            myDonutChart.data.datasets.forEach(function(datasets) {
                                datasets.data = this.thisyeardatas;
                            });
                            myDonutChart.update();

                        } else {
                            alert("There is no any records")
                        }

                        if (response.data.searchmonthly.telenor.length != 0) {
                            this.monthlyreportpermonthotherapislabel = response.data.searchmonthly.label;
                            var monthlytelenordirectdata = [];
                            var monthlyotherapidata = [];
                            response.data.searchmonthly.telenor.forEach((v,i)=>{
                                monthlytelenordirectdata.push(response.data.searchmonthly.telenor[i].total)
                                monthlyotherapidata.push(response.data.searchmonthly.other[i].total)
                            })
                            this.monthlyreportpermonthtelenordirectdata = monthlytelenordirectdata;
                            this.monthlyreportpermonthotherapisdata = monthlyotherapidata;
                            myBarChart.data.datasets[0].data = this.monthlyreportpermonthtelenordirectdata;
                            myBarChart.data.datasets[1].data = this.monthlyreportpermonthotherapisdata;
                            
                            myBarChart.data.labels = this.monthlyreportpermonthotherapislabel;
                            myBarChart.update();
                            // console.log(monthlytelenordirectdata);
                            
                        }

                    })

            }else{
                alert('Invalid Date!')
            }
        }

        var ysdownload = function () { 
            var yearsearchdownload = document.querySelector(".ysdatework").value;
            
            if (yearsearchdownload != "" && yearsearchdownload > '2019') {
                // get search value and find in db and use axios
                axios.get('/api/yearlysearchreportexport',{params: {yearsearchdownload: yearsearchdownload }})
                .then(({data}) => {
                    const yearsearchexportlink = document.createElement('a');
                    yearsearchexportlink.href = '/api/yearlysearchreportexport';

                    document.body.appendChild(yearsearchexportlink);
                    yearsearchexportlink.click();
                    yearsearchexportlink.remove();
                    console.log(data)
                })
                
            } else if (yearsearchdownload == "" || yearsearchdownload > '2019'){
                axios.get('/api/yearlyreportexport')
                .then(({ data }) => {
                    const link = document.createElement('a');
                    link.href = '/api/yearlyreportexport';
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                });
            }else{
                alert('There is no any data you can download!')
            }
         }

        function dssearchwork() {
            //Get the text in the elements
            var fromdate = document.querySelector('.fromdate').value;
            var todate = document.querySelector('.todate').value;
           
            if (fromdate < todate) {
                return axios.post('/api/dsearch',{
                    fromdate : fromdate,
                    todate : todate
                }).then(response => {
                        console.log(response.data)
                        var dailysearchresultdatedata = [];
                        var dailysearchresulttelenordata = [];
                        var dailysearchresultotherapidata = [];
                        response.data.telenor.forEach((v,i) => {
                            dailysearchresulttelenordata.push(response.data.telenor[i].sms_count);
                            dailysearchresultotherapidata.push(response.data.other[i].sms_count);
                            dailysearchresultdatedata.push(response.data.telenor[i].counted_date);
                            
                        });
                        this.dailyreporttelenordirectdata = dailysearchresulttelenordata;
                        this.dailyreportotherapidata = dailysearchresultotherapidata;
                        this.dailyreportdatedata = dailysearchresultdatedata;
                        myLineChart.data.datasets[0].data = this.dailyreporttelenordirectdata;
                        myLineChart.data.datasets[1].data = this.dailyreportotherapidata;
                        myLineChart.data.labels = this.dailyreportdatedata;
                        myLineChart.update();
                    })
            }else{
                alert("Invalid date!")
            }
        }

        
        $(document).ready(function () {
            $(".scrolleff1").click(function (){
                $('html, body').animate({
                    scrollTop: $(".scrolleffto1").offset().top
                }, 3000);
            });
        });
    </script>
@endsection