<?php
function lawyers($row) {
    $Pic = $row['Photo'] ?? '';
    $lawyerName = $row['name'] ?? '';
    $lawyerLocation = $row['location'] ?? '';
    $lawyerPracticeArea = $row['speciality'] ?? '';

    if (empty($Pic) || empty($lawyerName) || empty($lawyerLocation) || empty($lawyerPracticeArea)) {
        return null;
    }

    $content = "
        <div class='wrapper' style=''>
        <form action='profile' method='post'>
            <div class='accordion' style='width:75%;margin:0px auto;'>
                <div class='card'>
                    <div class='card-header' id='headingOne'>
                        <h2 class='mb-0'>
                            <button class='btn btn-link btn-block text-left' type='button' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
                                <a href='lawyer_create'>
                                    <span class='d-flex justify-content-center'>
                                        <p class='lawyer-photo' style='
                                            width:2.5rem;
                                            height:2.5rem;
                                            background-size: cover;
                                            background-image: url($Pic);'
                                        ></p>
                                        <p class='w-33 align-middle'>$lawyerName</p>
                                        <p class='w-33 align-middle'>$lawyerLocation</p>
                                        <p class='w-33 align-middle'>$lawyerPracticeArea</p>
                                    </span>
                                </a>
                            </button>
                        </h2>
                    </div>
                </div>
            </div>
        </form>
        </div>";

    return $content;
}
