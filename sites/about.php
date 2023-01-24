<!DOCTYPE html>
<html>

<head>
        <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
        <style>
                * {
                        box-sizing: border-box;
                }

                .row {
                        margin-left: -5px;
                        margin-right: -5px;
                }

                .column {
                        float: left;
                        width: 25%;
                        padding: 5px;
                }

                /* Clearfix (clear floats) */
                .row::after {
                        content: "";
                        clear: both;
                        display: table;
                }

                table {
                        border-collapse: collapse;
                        border-spacing: 0;
                        width: 30%;
                        border: 1px solid #ddd;
                        box-shadow: 1px 1px 1px #999;
                }

                th,
                td {
                        text-align: center;
                        font-size: 13px;
                        padding: 6px;
                }

                tr:nth-child(even) {
                        background-color: #f2f2f2;
                }

                .button {
                        border: none;
                        outline: 0;
                        display: inline-block;
                        padding: 8px;
                        color: white;
                        background-color: #000;
                        text-align: center;
                        cursor: pointer;
                        width: 100%;
                }

                .button:hover {
                        background-color: #555;
                }
        </style>
</head>

<body>


        <p align="center">
        <h1> Meet the Team</h1>
        </p>
        <p align="center"> ~These are the people that make the magic happen~ </p>
        <div class="row">
                <div class="column">
                        <table>
                                <tr>
                                        <td><img src="images/team/nelly.jpg" alt="nelly2" width="150" height="250"></td>

                                </tr>
                                <tr>
                                        <td>Nur Hidayah Binti Ishak</td>

                                </tr>
                                <tr>
                                        <td>2020496204</td>

                                </tr>
                                <tr>
                                        <td>2020496204@student.uitm.edu.my</td>

                                </tr>
                                <tr>
                                        <td><a href="http://linkedin.com/in/nurhidayahishak1985" target="_top"><button
                                                                class="button">Contact</button></a></td>
                                </tr>
                        </table>
                </div>
                <div class="column">
                        <table>
                                <tr>
                                        <td><img src="images/team/sven.jpg" alt="sven2" height="250"></td>

                                </tr>
                                <tr>
                                        <td>Frei Sven</td>

                                </tr>
                                <tr>
                                        <td>2022828866</td>

                                </tr>
                                <tr>
                                        <td>2022828866@student.uitm.edu.my</td>

                                </tr>
                                <tr>
                                        <td><button class="button">Contact</button></td>
                                </tr>
                        </table>
                </div>
                <div class="column">
                        <table>
                                <tr>
                                        <td><img src="images/team/arif.JPEG" alt="arif" height="250"></td>

                                </tr>
                                <tr>
                                        <td>Muhammad Nur Arif Bin Mohd Azman</td>

                                </tr>
                                <tr>
                                        <td>2021619936</td>

                                </tr>
                                <tr>
                                        <td>2021619936@student.uitm.edu.my</td>

                                </tr>
                                <tr>
                                        <td><button class="button">Contact</button></td>
                                </tr>
                        </table>
                </div>
                <div class="column">
                        <table>
                                <tr>
                                        <td>picture here</td>

                                </tr>
                                <tr>
                                        <td>Na’bil Bin Saperi</td>

                                </tr>
                                <tr>
                                        <td>2022971889</td>

                                </tr>
                                <tr>
                                        <td>nabilsaperi@gmail.com </td>

                                </tr>
                                <tr>
                                        <td><button class="button">Contact</button></td>
                                </tr>
                        </table>
                </div>
        </div>
        <!--<table>
<tr align="center">
        <td>picture here</td>
        <td>picture here</td>
        <td>picture here</td>
        <td>picture here</td>
</tr>
<tr align="center" bgcolor="#F4D03F"  >
        <td>Nur Hidayah Binti Ishak</td>
        <td>Frei Sven</td>
        <td>Muhammad Nur Arif Bin Mohd Azman</td>
        <td>Na’bil Bin Saperi</td>
</tr>
<tr align="center">
        <td>2020496204</td>
        <td>2022828866</td>
        <td>2021619936</td>
        <td>2022971889</td>
</tr>
<tr align="center">
        <td>2020496204@student.uitm.edu.my</td>
        <td>2022828866@student.uitm.edu.my </td>
        <td>2021619936@student.uitm.edu.my </td>
        <td>2021619936@student.uitm.edu.my </td>
</tr>
</table>-->






</body>

</html>