<html>
<head>
	<title>Result Export - PDF</title>

	<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

	<style type="text/css" media="all">
		body {
            font: 10px;
        }

        th, td {
        	padding: 5px 15px 5px 5px;
        	border: 1px solid #f4f4f4;
        }
	</style>
</head>

<body>
	
	<table style="border-collapse: collapse;">
		<tr>
			<td style="width: 100px;"><b>Name</b></td>
			<td style="text-align: center;">:</td>
			<td>{{ @$result['name'] ?? '-' }}</td>
		</tr>
		<tr>
			<td><b>Career</b></td>
			<td>:</td>
			<td>{{ @$result['career'] ?? '-' }}</td>
		</tr>
		<tr>
			<td><b>Module</b></td>
			<td>:</td>
			<td>{{ @$result['module'] ?? '-' }}</td>
		</tr>
		<tr>
			<td><b>Question Answered</b></td>
			<td>:</td>
			<td>{{ @$result['question_answered'] ?? '-' }}/{{ @$result['total_question'] }}</td>
		</tr>
		<tr>
			<td><b>Final Score</b></td>
			<td>:</td>
			<td>{{ @$result['final_score'] ?? '-' }}/{{ @$result['total_score'] }}</td>
		</tr>
	</table>

	<table style="margin-top: 20px; border-collapse: collapse;">
		<thead>
			<tr>
				<th style="text-align: left; background: #e8effb;">Category - Type</th>
				<th style="width: 70px; text-align: left; background: #e8effb;">Result</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $item)
				<tr>
					<td>{{ @$item['step']['name'] }}</td>
					<td>{{ @$item['user_answer'] == @$item['right_answer'] ? 'CORRECT' : 'INCORRECT' }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
