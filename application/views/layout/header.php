<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Input Data</title>
    <style>
        *{
            font-family: sans-serif;
        }
        body{
            background: #eee;
            color: #333;
            font-size:15px;
        }
        
        #wrapper{
            background: #fff;
            width: 75%;
            margin: 20px auto;
        }
        
        #wrapper header{
            background: #1c2541;
            border-radius: 5px;
            padding: 20px;	
        }
        
        #wrapper header hgroup{
            float: left;	
            color: black;
        }
        #wrapper header nav{	
            float: right;
            margin-top: 50px;		
        }
        
        #wrapper header nav ul, .footer-title ul{
            padding: 0;
            margin: 0;
        }
        
        #wrapper header nav ul li{
            float: left;
            list-style: none;	
            font-weight: bold;
            
        }
        
        #wrapper header nav ul li a{
            padding: 15px;	
            color: white;
            text-decoration: none;
        }
        .clear{
            clear: both;
        }
        
        footer{
            background: #1c2541;
            padding: 20px;
            border-radius: 5px;
            color: black;
        }
        
        footer a{
            color: white;
            text-decoration: none;
        }
        
        section{
            padding: 20px;
        }

        .container{
            width: 70%;
            margin: 15px, auto;
        }

        .copyright{
            text-align: center;
            font-size: 10px;
        }

        .footer-title li{
            list-style: none;
            font-weight: bold;
        }
        .footer-title ul li a{
            color: white;
            text-decoration: none;
        }

        .logo{
            width: 400px;
        }

        .footer-content p, .footer-title{
            font-weight: bold;
            text-align: center;
            color: #fff;
        }

        .footer-title h4{

        }

        section p{
            text-align: justify;
        }

        .copyright{
            color: #fff;
        }

        
    </style>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
    <script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js'); ?>"></script>
    <!--load datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/jquery-ui/jquery-ui.css'); ?>">
    <script src="<?php echo base_url('assets/jquery-ui/jquery-ui.js'); ?>"></script>
    <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.min.css'); ?>"/>
    <script type="text/javascript" src="<?php echo base_url('assets/DataTables/datatables.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url().'assets/chart/Chart.bundle.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/chart/Chart.js'?>"></script>
</head>
<body>
<div id="wrapper">
    <header>
        <hgroup><a href="<?php echo base_url()?>index.php/Welcome">
        <img class="logo" src="<?php echo base_url()?>assets/logo/logoputih.png" alt="logo"></a>
        </hgroup>
    <nav>
        <ul>
            <li><a href="<?php echo base_url()?>index.php/Welcome">Halaman Utama</a></li>
            <li><a href="<?php echo base_url()?>index.php/Mahasiswa">Data Mahasiswa</a></li>
            <li><a href="<?php echo base_url()?>index.php/Grafik">Laporan</a></li>
            <li><a href="<?php echo base_url()?>index.php/Welcome/about">Peta Lokasi</a></li>
        </ul>
    </nav>
    <div class="clear"></div>
</header>