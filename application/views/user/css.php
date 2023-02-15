
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">  

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url() . "assets/"; ?>owl.theme.default.min.css">
  <style>
       @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;

            }
            
            

            .empty {
                display: none;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
                
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }



            /*
		Label the data
		*/
            td:nth-of-type(1):before {
                content: "Sunday";
            }
            td:nth-of-type(2):before {
                content: "Monday";
            }
            td:nth-of-type(3):before {
                content: "Tuesday";
            }
            td:nth-of-type(4):before {
                content: "Wednesday";
            }
            td:nth-of-type(5):before {
                content: "Thursday";
            }
            td:nth-of-type(6):before {
                content: "Friday";
            }
            td:nth-of-type(7):before {
                content: "Saturday";
            }


        }

        /* Smartphones (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            body {
                padding: 0;
                margin: 0;
            }
        }

        .row{
            margin-top: 20px;
        }
        
        .today{
            background:#bbbbbb;
        }
        
        
        
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
  /* Make the image fully responsive */
  .carousel-inner img {
      width: 100%;
      height:100%;
  }
  </style>
  <style>
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      height: 100px;
      width: 100px;
      outline: black;
      border-radius: 50%;
      background-size: 100%, 100%;
      border: none;
      background-image: none;
    }

    .carousel-control-next-icon:after {
      content: '>';
      font-size: 55px;
      color: black;
    }

    .carousel-control-prev-icon:after {
      content: '<';
      font-size: 55px;
      color: black;
    }
  </style>


<style>
    body {
      background-color: #E5E5E5;
      font-family: 'Kanit', sans-serif;
    }
</style>



<style>
  /* Section Footer */

.semi-footer {
    background: #2b2b2b;
    color: #dcdcdc;
}

.semi-footer a {
    color: #dcdcdc;
}

.semi-footer li.active > a {
    color: #fff;
}

.semi-footer h4 {
    color: #75c6fc;
    border-bottom: 1px solid;
    padding: 10px 0;
}

.footer {
    background: #000;
    color: #fff;
    font-size: 0.7rem;
    height: 90px;
    line-height: 90px;
    text-align: center;
}

#map {
    height: 300px;
    width: 100%;
}
</style>
<style>
    .month {
  padding: 30px 30px;
  width: 100%;
  background: #17A2B8;
  text-align: center;
}
</style>
