<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  {{-- {{ $viewer }} --}}
  {{-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ url('/') }}%2Ff%2Fele%2B{{ asset('Testingku.docx') }}' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe> --}}
  <iframe src='https://view.officeapps.live.com/op/view.aspx?src=http%3A%2F%2Fapp.indonesiantobacco.com%2Fpublic%2FTestingku.docx&wdOrigin=BROWSELINK' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>
  {{-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ $files }}' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe> --}}
  {{-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=newteach.pbworks.com%2Ff%2Fele%2Bnewsletter.docx' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe> --}}
  {{-- <iframe src="https://docs.google.com/gview?url={{ asset('Testingku.docx') }}&embedded=true"></iframe> --}}
  {{-- <iframe src="https://docs.google.com/gview?url={{ $files }}&embedded=true" style="width: 100%; height: 768px" frameborder='0'></iframe> --}}
  {{-- <iframe src="{{ asset('Testingku.docx') }}" frameborder="0"></iframe> --}}
  {{-- <iframe src="{{ $link }}" frameborder="0"></iframe> --}}
</body>
</html>