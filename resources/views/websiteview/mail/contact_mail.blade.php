<!DOCTYPE html>
<html>
    <head>
        <style>
            table {

    font-family: arial, sans-serif;

    border-collapse: collapse;

    width: 100%;

}



td, th {

    border: 1px solid #dddddd;

    text-align: left;

    padding: 8px;

}



tr:nth-child(even) {

    background-color: #dddddd;

}
        </style>
    </head>
    <body>
        <h2>
            Contact Detail
        </h2>
        <table align="center" style="">
             <tr>
                <td>
                    Subject:
                </td>
                <td>
                    {{$subject ?? ''}}
                </td>
            </tr>
            <tr>
                <td>
                    Name:
                </td>
                <td>
                    {{$name ?? ''}}
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    {{$email ?? ''}}
                </td>
            </tr>
            <tr>
                <td>
                    Phone:
                </td>
                <td>
                    {{$phone ?? ''}}
                </td>
            </tr>
            <tr>
                <td>
                    Message:
                </td>
                <td>
                    {{$message1 ?? ''}}
                </td>
            </tr>
        </table>
    </body>
</html>