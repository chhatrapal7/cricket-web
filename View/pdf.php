<?php
$pg_slug = $_GET['slug'];  // php me slug liya gya
?>

<script type="text/javascript" src="<?php echo $baseurl; ?>jscontroller/pdf.js"></script>

<script>
    var pg_slug = "<?php echo $pg_slug; ?>"; // PHP ka variable JavaScript ke variable m_slug me chala gaya.
</script>


<div class="content-page" style="background-color: #fff;" ng-controller="pdf_under_jsapicontroller">

    <style>
        .container {

            font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: #fff;
            color: #222;
            padding: 18px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);

        }


        .container {
            border-style: solid;

        }

        .container1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #111;
            padding-bottom: 12px;
            margin-bottom: 14px;

        }

        .con-1 {
            width: 25%;
        }

        .con-2 {
            width: 50%;

        }


        .con-3 {
            width: 25%;


        }

        .container2 {
            /* padding-top: 10px;
        
            display: flex; */
            display: flex;
            justify-content: space-around;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px dashed #ccc;
            margin-bottom: 12px;
        }

        /* .one {
            width: 50%;
        } */



        /* .container3 {
            padding-top: 10px;
            border-top: dashed;
        } */
        .container3 {
            width: 100%;
            margin: 20px auto;
            padding: 10px;
            background-color: #fff;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            /* merge borders line then 1 line */
        }

        .table thead {
            background-color: #f2f2f2;
        }

        .table td,
        .table th {
            border: 1px solid black;
            /* black border around each cell */
            padding: 8px;
            text-align: center;
        }

        .table tr:nth-child(even) {
            background-color: #fafafa;
            /* alternate row color */
        }

        .table tr:hover {
            background-color: #e8e8e8;
            /* highlight on hover */
        }


        .container4 {
            text-align: right;
            margin-right: 20px;
        }
    </style>





    <div class="container">

        <center>
            <h4> LIFE CARE DIAGNOSTIC CENTRE </h4>
        </center>

        <div class="container1">

            <div class="con-1">
                <img src="images/lyfecare.jpeg" alt="Example" style="width:200px;">
            </div>

            <div class="con-2">
                <!-- <h4> LIFE CARE DIAGNOSTIC CENTRE </h4> -->
                <p>A UNIT OF LIFECARE SCAN AND RESEARCH PRIVATE LIMITED</p>
                <p><b> SHIVNATH COMPLEX, NEAR SBI BANK, BESIDE CHAUHAN ESTATE, SUPELA BHILAI </b></p>
                <p><b>Ph No.:0788-4910002, 03, 24 X 7.Mob No.: 9109176001 </b></p>
                <p>Website: lyfcare mobile:73738472628 </p>
            </div>

            <div class="con-3">
                <p>" Think Care "</p>
                <p> " Think LifeCare "</p>
                <p>24 X 7 Services</p>
            </div>

        </div>



        <div class="container2 " ng-repeat="srial in info | toArray" class="text-center">

            <div class="one">
                <p> Client Name : {{srial.Client_name}}</p>
                <p> Pt. Name : {{srial.pt_name}}</p>
            </div>

            <div class="two">
                <p> Age. : {{srial.DOB}} </p>
                <p> Receipt No. : {{srial.Receipt}} </p>
            </div>

            <div class="three">
                <p> Bill No. : {{srial.bill_number}} </p>
                <p> Mobile No. : {{srial.mobile}} </p>
            </div>

        </div>


        <div class="container3">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <td>Sr No.</td>
                        <td>Department</td>
                        <td>Cghs code</td>
                        <td>Test name</td>
                        <td>Rate</td>
                    </tr>
                </thead>
                <tbody>

                    <tr ng-repeat="srial in testss | toArray" class="text-center">
                        <td>{{$index + 1}}</td>
                        <td>{{srial.Department}} </td>
                        <td>{{srial.Test_code}} </td>
                        <td>{{srial.Test_name}} </td>
                        <td>{{srial.Rate}} </td>
                    </tr>
                </tbody>

            </table>
        </div>

        <div class="container4">

            <p> <b>Total Amount:</b>{{totalAmount }}</p>
            <p> <b>Discount Amount:</b>0.00</p>
            <p> <b>Total Bill Amount:</b>{{totalAmount }}</p>
            <p> <b>Totle Paid:</b>{{totalAmount }}</p>
            <p> <b>Balance Amount:</b>0.00</p>

        </div>

    </div>






</div>