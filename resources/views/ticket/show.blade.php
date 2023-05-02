<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="show">
        <h1>Ticket details</h1>
        <div class="text-dark flex justify-between py-4">
            <div class="table-responsive">

                <!--Table-->
                <table class="table">
                    <!--Table body-->
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $ticket->description }}</td>
                            <td>{{ $ticket->created_at->diffforhumans() }}</td>
                            @if ($ticket->attachment)
                                <td>
                                    <a href="{{ '/attachments/' . $ticket->attachment }}"
                                        style="color:#000; text-decoration:none;">Attachment</a>
                                </td>
                            @endif
                            <td>
                                <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('ticket.edit', $ticket->id) }}">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-info" href="">Aprove</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="">Reject</a>
                            </td>
                        </tr>
                    </tbody>
                    <!--Table body-->

                </table>
                <!--Table-->
            </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>
