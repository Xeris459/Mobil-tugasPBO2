<!DOCTYPE html>
<html lang="en">

<head>

    <!-- meta data -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= str_replace('-', ' ',$title) ?></title>

    <!-- icon set -->
    <!-- <link rel="shortcut icon" href="<?= base_url() ?>assets/img/fav.ico" /> -->

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/0aa1f9181b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/js/trumbowyg/dist/ui/trumbowyg.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/js/trumbowyg/dist/plugins/lainnya/ui/sass/trumbowyg.lainnya.css" rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <style>
    .gj-picker-bootstrap table tr td div {
        color: #292929;
    }

    .gj-picker-bootstrap table tr td.other-month div {
        color: #878787;
    }

    .gj-picker-bootstrap table tr td.disabled div {
        color: #b5b5b5;
    }

    .lds-dual-ring {
        position: relative;
        top: 50%;
        left: 45%;
        display: block;
        width: 80px;
        height: 80px;
    }

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #365DCD;
        border-color: #365DCD transparent #365DCD transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #message {
        position: absolute;
        top: 0;
        right: 0;
        width: 30%;
        z-index: 999;
        margin-top: 10px;
    }

    /* #mess {
        position: relative;
        top: 0;
        right: 0;
        /* width: 30%;
        z-index: 999;
        margin-top:10px; */
    }

    */ .alert {
        position: fixed;
    }

    #inner-message {
        margin: 0 auto;
    }

    .modal {
        padding: 0 !important; // override inline padding-right added from js
    }

    .modal .modal-dialog {
        width: 60%;
        max-width: none;
    }

    .modal .modal-content {
        border: 0;
        border-radius: 0;
    }

    .modal .modal-body {
        overflow-y: auto;
    }

    label {
        width: 100%;
        font-size: 1rem;
    }

    .lead {
        font-size: 1rem;
        font-weight: 400 !important;
    }

    .card-input-element+.card {
        height: calc(150px + 2*1rem);
        color: var(--primary);
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 2px solid transparent;
        border-radius: 4px;
    }

    .card-input-element+.card:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card {
        border: 2px solid var(--primary);
        -webkit-transition: border .3s;
        -o-transition: border .3s;
        transition: border .3s;
    }

    .card-input-element:checked+.card::after {
        content: '\e5ca';
        color: #AFB8EA;
        font-family: 'Material Icons';
        font-size: 24px;
        -webkit-animation-name: fadeInCheckbox;
        animation-name: fadeInCheckbox;
        -webkit-animation-duration: .5s;
        animation-duration: .5s;
        -webkit-animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    @-webkit-keyframes fadeInCheckbox {
        from {
            opacity: 0;
            -webkit-transform: rotateZ(-20deg);
        }

        to {
            opacity: 1;
            -webkit-transform: rotateZ(0deg);
        }
    }

    @keyframes fadeInCheckbox {
        from {
            opacity: 0;
            transform: rotateZ(-20deg);
        }

        to {
            opacity: 1;
            transform: rotateZ(0deg);
        }
    }
    </style>
</head>