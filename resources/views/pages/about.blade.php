@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.ubc.ca/clf/7.0.4/css/ubc-clf-full-bw.min.css">

<!-- Code can goes down here -->

<div class="container">
    <div class="row">

        <div style="width: 100%;border-bottom: 1px solid #DCDCDC">
            <h1 style="text-align:center;">About</h1>

        </div>
        <div class="ok-accordion-wrapper">
                <div id="ok-accordion-1" class="ok-accordion ok-accordion-blue">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="#section-2" data-toggle="collapse" data-parent="ok-accordion-1">What is Curriculum Mapping</a>
                        </div>
                        <div id="section-2" class="accordion-body in collapse" style="height:auto;">
                            <div class="accordion-inner">
                                <p>Curriculum mapping is an instrument to evaluate the alignment of learning objectives to academic strategies at educational institutions. The mapping process is an effective way to - </p>
                                <ul>
                                    <li>“make learning and teaching more meaningful to students and teachers” (Lam and Tsui, 2016); </li>
                                    <li>“develop, review, improve and perfect an integrated curriculum, including curriculum alignment” (Khoerunnisa et al, 2018); and </li>
                                    <li>“understand curriculum structures and relationships, gain insight in how students experience their discipline, and increase awareness of curricular content” (Archambault and Masunaga, 2015). </li>
                                </ul>
                                <p><a href="https://strategicplan.ubc.ca/transformative-learning/">UBC’s Strategic Plan’s Strategy on Transformative Learning</a> focuses on an important cornerstone of the curriculum mapping process. The strategy notes that: </p>
                                <p><i>Our work at UBC is focused on enhanced support for program redesign around competencies; the development of problem-solving experiences; technology-enabled learning; and continued growth in work-integrated education. Sustained progress requires leadership across the institution to model, inspire and celebrate excellence in teaching and mentorship. </i></p>
                                <p>To create an immersive learning experience that fosters competencies identified by faculties and departments as critical to the discipline, a curriculum map can be an <strong>effective way to visualize the program structure, list of courses, teaching and learning activities, and assessment practices.</strong> This “integrative and sustainable” (Kalu & Dyjur, 2018) process is collaborative and <strong>geared towards student success.</strong></p>
                            </div>
                        </div>
                    </div>
                </div>    
        </div>

    </div>
</div>





<script>

</script>

<!-- End here -->
@endsection
