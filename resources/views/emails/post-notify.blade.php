<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Get in Touch</title>
    <!-- Mobile Specific Meta
        ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style type="text/css">
        body{
            background: #f2f3f7;
            padding-top: 10px;
            padding-bottom: 10px;
            font-family: 'Roboto', sans-serif;
        }

        *{
            font-family: 'Roboto', sans-serif;
        }

        .invitation-container{
            background: #fff;
            display: block;
            max-width: 615px;
            width: 100%;
            margin: auto;
            border: none;
            overflow: hidden;
            border-radius: 15px;
        }

        .invitation-header {
            padding: 30px 15px 16px;
            text-align: center;
            background: #fff;
        }
        .invitation-header img{
            margin-top: 10px;
        }
        .invitation-body {
            padding: 0px 38px;
        }

        .invitation-body .mail-container-inner-kps {
            padding: 15px 0px 10px;
        }

        .invitation-body h1{
            text-align: left;
            margin: 15px 0px 0px;
            font-weight: 500;
            font-size: 22px;
            color: #212121;
        }

        .invitation-body div.flex-view{
            text-align: center;
        }

        .invitation-body div.flex-view .img-container{
            width: 100px;
        }

        .invitation-body div.flex-view .img-container img{
            margin-bottom: 0;
        }


        .invitation-body div.flex-view .desc-container{
            align-self: center;
            padding: 15px 0px;
            flex: 1;
        }

        .invitation-body .desc-container p{
            margin: 0px;
            font-size: 15px;
            line-height: 1.34;
        }

        .invitation-body .desc-container p span.coach-name{
            font-weight: 500;
        }

        .invitation-body .desc-container p.series-name{
            font-size: 25px;
            margin-top: 5px;
            margin-bottom: 5px;
            font-weight: 500;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
        }

        .invitation-body .desc-container p.title{
            font-size: 16px;
            margin-bottom: 20px;
            font-weight: 500;
            text-align: left;
        }

        .invitation-body .desc-container p.title span{
            color: #0D47A1;
            font-weight: 500;
        }

        .invitation-body .desc-container p.note-title{
            text-align: left;
            margin-bottom: 10px;
        }

        .invitation-body .desc-container p.note-desc{
            text-align: left;
            font-size: 16px;
            line-height: 1.5;
            color: #212121;
        }

        .invitation-body .desc-container p.note-footer{
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            margin-bottom: -15px;
        }

        .invitation-body .desc-container p a{
            color: inherit;
            text-decoration: none;
            font-weight: 500;
        }

        .user-container{
            display: flex;
            align-items: center;
            padding-left: 10px;
        }

        .user-container .img-container{

        }

        .user-container .img-container img{
            width: 25px;
            height: 25px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .user-container .name-container {

        }

        .user-container .name-container p{
            margin: 0px;
            font-size: 15px;
            font-weight: 500;
            margin-top: 0px;
        }

        .date-time {
            padding-left: 10px;
            margin-top: 10px;
            font-size: 15px;
        }

        .date-time p{
            margin: 8px 0 4px;
            font-weight: 500;
            line-height: 1.5;
            color: #212121;
        }
        .date-time p.message-flex-box-kps{
            display: flex;
            flex-direction: row;
            justify-content: left;
            align-items: flex-start;

        }
        .date-time p span{
            font-weight: 400;
            color: #666666;
            padding-right: 2px;
            font-size: 14px;
            width: clamp(135px, 100%, 140px);
            display: inline-block;

        }
        .date-time p span.message-title-kps{
            min-width: 151px;
        }

        .date-time p span.message-body-text-kps{
            width: 100%;
            font-weight: 500;
            line-height: 1.7;
            color: #212121;
        }

        .btn-container{
            padding: 18px 0px 20px;
            text-align: center;
        }

        .btn-joinMeeting {
        margin: auto;
        padding: 15px 20px;
        text-align: center;
        font-family: 'Roboto', sans-serif;
        transition: 0.5s;
        color: #fff !important;
        box-shadow: 0 0 20px #eee;
        border-radius: 5px;
        display: block;
        width: 40%;
        font-size: 15px;
        font-weight: 400;
        text-decoration: none;
        background: #5e35b1;
        }

        p.cheers{
            text-align: left;
            font-size: 12px;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        p.copyright-kps{
            text-align: center;
            font-size: 12px;
            margin-top: 16px;
            margin-bottom: 23px;
            color: #9e9e9e;
            font-weight: 400;
        }
        p.cheers span{
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
        }

        p.note{
            color: #757575;
            font-size: 13px;
            margin-bottom: 0px;
            margin-top: -3px;
            line-height: 1.4em;
        }

        .invitation-footer {
            padding: 0px 15px;
            text-align: left;
            text-align: center;
        }

        .invitation-footer a{
            text-decoration: none;
            color: #0D47A1;
        }
        .thank-section-kps {
            display: block;
            width: 100%;
            padding: 20px 0px;
            border-bottom: 1px solid #e0e0e0;
        }
        .thank-section-kps > p {
            font-size: 13px;
            font-weight: 400;
            margin: 0;
            line-height: 18px;
            color: #666666;
        }
        @media (max-width: 767px) {
            .invitation-body {
                padding: 11px 12px;
            }
        }
    </style>
</head>

<body style="margin: 0; padding-top: 30px; padding-bottom: 30px; width: 100%; background: #f2f3f7;">

<div class="invitation-container">
    <div class="invitation-header">
        <img src="{{ asset('img/brand/logo.svg') }}" width="170px;">
    </div>

    <div class="invitation-body">
        <h1>You’ve received post approval.</h1>
        <div class="mail-container-inner-kps">
            <div class="date-time">
                <p><span>Content:</span> <br>{{ $content }}</p>
            </div>
        </div>
    </div>
    <div class="invitation-footer">
        <p class="note">This email was sent from a no-reply email address that can’t accept incoming email. <br> So, please do not reply to this message.</p>
        <p class="copyright-kps"> {{ date('Y') }} &copy; Inc. All rights reserved.</p>
    </div>
</div>
</body>
</html>