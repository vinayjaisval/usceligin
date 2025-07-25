@extends('layouts.admin')
@section('styles')
<style>
    * {
        margin: 0;
        padding: 0;
    }

    #hiddenData {
        display: none;
    }

    #hiddenData button {
        border: 1px solid #ccc;
        padding: 5px 10px;
        text-decoration: none;
        color: #666;
        font-family: Arial, Verdana, Tahoma;
        font-size: 11px;
        display: inline-block;
        border-radius: 5px;
        transition: all 0.5s;
    }

    .tree ul {
        padding-top: 20px;
        position: relative;
        transition: all 0.5s;
    }

    .tree li {
        float: left;
        text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 5px 0 5px;
        transition: all 0.5s;
    }

    .tree li::before,
    .tree li::after {
        content: '';
        position: absolute;
        top: 0;
        right: 50%;
        border-top: 1px solid #ccc;
        width: 50%;
        height: 20px;
    }

    .tree li::after {
        right: auto;
        left: 50%;
        border-left: 1px solid #ccc;
    }

    .tree li:only-child::after,
    .tree li:only-child::before {
        display: none;
    }

    .tree li:only-child {
        padding-top: 0;
    }

    .tree li:first-child::before,
    .tree li:last-child::after {
        border: 0 none;
    }

    .tree li:last-child::before {
        border-right: 1px solid #ccc;
        border-radius: 0 5px 0 0;
    }

    .tree li:first-child::after {
        border-radius: 5px 0 0 0;
    }

    .tree ul ul::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        border-left: 1px solid #ccc;
        width: 0;
        height: 20px;
    }

    .tree li a {
        border: 1px solid #ccc;
        padding: 5px 10px;
        text-decoration: none;
        color: #666;
        font-family: Arial, Verdana, Tahoma;
        font-size: 11px;
        display: inline-block;
        border-radius: 5px;
        transition: all 0.5s;
    }

    .tree li a:hover,
    .tree li a:hover+ul li a {
        background: #c8e4f8;
        color: #000;
        border: 1px solid #94a0b4;
    }

    .tree li a:hover+ul li::after,
    .tree li a:hover+ul li::before,
    .tree li a:hover+ul::before,
    .tree li a:hover+ul ul::before {
        border-color: #94a0b4;
    }

    .tree ul {
        list-style-type: none;
        padding: 0;
    }

    .tree li {
        margin: 5px 0;
        cursor: pointer;
    }

    .tree .action-button {
        /* display: block; */
        margin-top: 10px;
        border: 1px solid #ccc;
        padding: 5px 10px;
        text-decoration: none;
        color: #666;
        font-family: Arial, Verdana, Tahoma;
        font-size: 11px;
        background-color: transparent;
        border-radius: 5px;
        transition: all 0.5s;
    }

    .action-buttons {
        display: flex;
        gap: 10px;

    }

    .tree .action-button::after {
        right: auto;
        left: 50%;
        border-left: 1px solid #ccc;
    }

    .tree .action-button::before,
    .tree .action-button::after {
        content: '';
        position: absolute;
        top: 0px;
        right: 52%;
        border-top: 1px solid #ccc;
        width: 50%;
        height: 20px;
    }


    .tree .action-button:last-child::before {
        border-right: 1px solid #ccc;
        border-radius: 0 5px 0 0;
    }

    .action-button:focus {
        outline: none;

    }

    .tree ul .action-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        border-left: 1px solid #ccc;
        width: 0;
        height: 20px;
    }

    /* .action-button::before, .action-button::after {
    content: '';
    position: absolute;
    top: 50px;
    right: 50%;
    border-top: 1px solid #ccc;
    width: 50%;
    height: 20px;
} */
    /* .action-button::after {
    right: auto;
    left: 50%;
    border-left: 1px solid #ccc;
} */
    .tree .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .action-button {
        display: inline-block;
        border: 1px solid #ccc;
        padding: 5px 10px;
        text-decoration: none;
        color: #666;
        font-family: Arial, Verdana, Tahoma;
        font-size: 11px;
        border-radius: 5px;
        transition: all 0.5s;
        background-color: transparent;
        margin: 5px 0;
    }

    .action-button:hover {
        background: #c8e4f8;
        color: #000;
        border: 1px solid #94a0b4;
    }

    .action-buttons {
        display: none;
        /* Initially hidden */
        margin-top: 10px;
    }

    .action-button {
        margin: 5px;
        padding: 10px;
        border: 1px solid #ccc;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="content-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Affiliate Users</h4>
                    </div>
                    <div class="card-body mb-3 mx-auto">
                        <div class="tree">
                            @php
                            $buildNestedList = function ($users, $parentId = null) use (&$buildNestedList) {
                            $html = '<ul>';
                                foreach ($users as $user) {
                                if ($user['reffered_by'] == $parentId) {
                                $html .= '<li><a href="#">' . htmlspecialchars($user['name']) . '</a>';
                                    $html .= $buildNestedList($users, $user['id']);
                                    $html .= '</li>';
                                }
                                }
                                $html .= '</ul>';
                            return $html;
                            };
                            $usersArray = $users->toArray();
                            echo $buildNestedList($usersArray);
                            @endphp
                        </div>
                    </div>
                </div>
                <!-- <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body mb-3 mx-auto">
                        <div class="tree">
                            <ul>
                                <li>
                                    <a href="" class="button">Button 1</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Button 2</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Button 3</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Button 4</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Button 4</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Button 4</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Button 4</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Button 4</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Button 4</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Button 4</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a href="" class="button">Bhumika</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Satrangi</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Holika</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Nilamber</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Ankit</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Nitin</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Sakshi</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Prighya</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Moni</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Kalia</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Kallu</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Bhumi</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li><a href="#">Santosh Kumar Pandey</a>
                                    <ul></ul>
                                </li>
                                <li><a href="#">shaily</a>
                                    <ul></ul>
                                </li>

                                <li><a href="#" class="button">ade</a>
                                    <ul>
                                        <li><a href="#" class="button">Shivani rawat</a>
                                            <ul></ul>
                                            <div class="action-buttons"></div>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#" class="button">Sochanu</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>
                                </li>




                                <li><a href="#" class="button">Jessica Bajaj</a>
                                    <ul>
                                        <li><a href="#" class="button">ade</a>
                                            <ul>
                                                <li><a href="#" class="button">Shivani rawat</a>
                                                    <ul></ul>
                                                    <div class="action-buttons"></div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#" class="button">Sochanu</a>
                                            <ul></ul>
                                            <div class="action-buttons"></div>
                                        </li>
                                        <li><a href="#" class="button">Sweety k</a>
                                            <ul></ul>
                                            <div class="action-buttons"></div>
                                        </li>
                                        <li><a href="#" class="button">Abhi</a>
                                            <ul></ul>
                                            <div class="action-buttons"></div>
                                        </li>
                                        <li><a href="#" class="button">Novel Sahu</a>
                                            <ul></ul>
                                            <div class="action-buttons"></div>
                                        </li>
                                        <li><a href="#" class="button">Anubhuti</a>
                                            <ul></ul>
                                            <div class="action-buttons"></div>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="#" class="button">Nitesh Kumar</a>
                                    <ul>
                                        <li><a href="#" class="button">ade</a>
                                            <ul>
                                                <li><a href="#" class="button">Shivani rawat</a>
                                                    <ul></ul>
                                                    <div class="action-buttons"></div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#" class="button">Sochanu</a>
                                            <ul></ul>
                                            <div class="action-buttons"></div>
                                        </li>


                                    </ul>
                                </li>

                                <li>
                                    <a href="" class="button">Bhumika</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Satrangi</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Holika</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Nilamber</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Ankit</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Nitin</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Sakshi</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Prighya</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>

                                <li>
                                    <a href="" class="button">Ranjit Mourya</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Bhumi Malhotra</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Bhumika Divakar</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Satrangi Bulbul</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Holika Kumari</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Nilamber Singh</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>

                                <li>
                                    <a href="" class="button">43456cfggb bhuji</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>


                                <li>
                                    <a href="" class="button">Bhumika</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Satrangi</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Holika</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Nilamber</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Ankit Daksh Puri</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Litanshi sing</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Keshvi Singh</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Nitesh Kumar </a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Moni Rai Sign</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Kalia Ram Singh</a>
                                    <ul></ul>
                                    <div class="action-buttons"></div>

                                </li>
                                <li>
                                    <a href="" class="button">Kallu Manali Singh</a>
                                    <ul></ul>
                                   

                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.button').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const buttonContainer = this.nextElementSibling; // Find the associated action buttons container

            // Toggle the visibility of 5 buttons on clicking the same button
            if (buttonContainer.style.display === 'none' || buttonContainer.style.display === '') {
                buttonContainer.style.display = 'block'; // Show 5 action buttons
                addButtons(buttonContainer); // Add action buttons if they don't exist
            } else {
                buttonContainer.style.display = 'none'; // Hide 5 action buttons
            }
        });
    });

    function addButtons(container) {
        // Create 5 action buttons (if not already created)
        if (!container.classList.contains('buttons-created')) {
            for (let i = 0; i < 5; i++) {
                const button = document.createElement('button');
                button.textContent = 'Action ' + (i + 1);
                button.classList.add('action-button');

                // Add event listener to toggle the action buttons for each of the 5 buttons
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    let newButtonContainer = this.nextElementSibling;

                    // Toggle the 5 action buttons for the clicked button
                    if (newButtonContainer.style.display === 'none' || newButtonContainer.style.display === '') {
                        newButtonContainer.style.display = 'block'; // Show new action buttons
                        addButtons(newButtonContainer); // Add action buttons if they don't exist
                    } else {
                        newButtonContainer.style.display = 'none'; // Hide new action buttons
                    }
                });

                container.appendChild(button);
            }
            container.classList.add('buttons-created');
        }
    }
</script>




@endsection