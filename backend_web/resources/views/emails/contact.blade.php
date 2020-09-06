<!DOCTYPE html>
<html>
<head>
    <title>{{ $data["title"] ?? "" }}</title>
</head>
<body>
<p>
    Hello <b>{{$data["name"] ?? ""}}!</b> This is an automatic response. <br/>
    Thank you for contacting me. <br/>
    I send you a copy of the contact message. I will respond ASAP. <br/>
    Cheers.
</p>
<div style="border: 1px solid #ccc; padding:3px;">
    <h4>Subject:<br/> "{{ $data["subject"] ?? "" }}" </h4>
    <h4>Message:</h4>
    <p>{{ $data["message"] ?? "" }}</p>
</div>
<p>
    <b>Eduardo A.F.</b> <br/>
    <small><b>Fullstack Developer - Madrid</b></small><br/>
    <a href="http://eduardoaf.com">eduardoaf.com</a>
</p>
</body>
</html>
