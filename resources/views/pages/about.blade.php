@extends('layouts.app')

@section('content')
<link href=" {{ asset('css/about.css') }}" rel="stylesheet" type="text/css" >

<!-- Code can goes down here -->

<div class="container">
    <div class="row">

        <div style="width: 100%;border-bottom: 1px solid #DCDCDC">
            <h1 style="text-align:center;">About</h1>

        </div>
        <!--
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
        </div> -->
        <div id="accordion">
            <ul>
                <li>
                    <details>
                        <summary><h3>What is Curriculum Mapping</h3></summary>
                        <div class= "summary-body">
                            <p>Curriculum mapping is an instrument to evaluate the alignment of learning objectives to academic strategies at educational institutions. The mapping process is an effective way to - </p>
                            <ul>
                                <li>“make learning and teaching more meaningful to students and teachers” (Lam and Tsui, 2016); </li>
                                <li>“develop, review, improve and perfect an integrated curriculum, including curriculum alignment” (Khoerunnisa et al, 2018); and </li>
                                <li>“understand curriculum structures and relationships, gain insight in how students experience their discipline, and increase awareness of curricular content” (Archambault and Masunaga, 2015). </li>
                            </ul>
                            <br>
                            <p><a href="https://strategicplan.ubc.ca/transformative-learning/">UBC’s Strategic Plan’s Strategy on Transformative Learning</a> focuses on an important cornerstone of the curriculum mapping process. The strategy notes that: </p>
                            <p><i>Our work at UBC is focused on enhanced support for program redesign around competencies; the development of problem-solving experiences; technology-enabled learning; and continued growth in work-integrated education. Sustained progress requires leadership across the institution to model, inspire and celebrate excellence in teaching and mentorship. </i></p>
                            <p>To create an immersive learning experience that fosters competencies identified by faculties and departments as critical to the discipline, a curriculum map can be an <strong>effective way to visualize the program structure, list of courses, teaching and learning activities, and assessment practices.</strong> This “integrative and sustainable” (Kalu & Dyjur, 2018) process is collaborative and <strong>geared towards student success.</strong></p>
                        </div>          
                    </details>
                </li>
                <li>
                    <details>
                        <summary><h3>Benefits of Curriculum Mapping</h3></summary>
                        <div class= "summary-body">
                            <ul>
                                <li><strong>Improve student learning:</strong> Curriculum mapping helps faculty use evidence-based information, see relationships between course and overall program goals, and learning outcomes; </li>
                                <li><strong>Student success:</strong> Curriculum mapping gives students a better understanding of what is expected of them, and what they will accomplish from different courses and program components; </li>
                                <li><strong>Quality assurance:</strong> Curriculum mapping allows for identification of gaps in course offerings as well as redundancies;</li>
                                <li><strong>Faculty collaboration and collegiality:</strong> Curriculum mapping provides an opportunity for faculty to work together. This can be especially useful to help new faculty entering a department develop professional relationships and a sense of belonging.</li>
                            </ul>
                        </div>
                    </details>
                </li>
                <li?>
                    <details>
                        <summary><h3>How to get the best out of this tool?</h3></summary>
                        <div class= "summary-body">
                            <p>This customizable online tool is a vehicle to curriculum mapping and alignment. The information presented after completing the tool’s wizard should allow instructors and departments make informed decisions to enhance the course/program as well as the overall student experience and learning.</p>
                            <p>To get the best results from using this tool, it is suggested that: </p>
                            <h4>At the course level</h4>
                            <ul>
                                <li><strong>Before using the tool:</strong> Collect all relevant information to navigate the wizard: course learning outcomes (CLOs), assessment methods, and teaching & learning activities.</li>
                                <ul>
                                    <li>Note: Identifying CLOs can be a difficult task for some. If you require assistance with articulating CLOs, contact the<a href="https://ctl.ok.ubc.ca/">Centre for Teaching and Learning </a> for support.  </li>
                                </ul>
                                <li>Once the tool draws its results, <strong>review, reflect,</strong> and take note of the course’s:</li>
                                <ul>
                                    <li>Strengths, weaknesses, areas for improvement</li>
                                    <li><strong>Share</strong> with other department colleagues to compare and contrast against other courses </li>
                                    <li>Consider comparing and contrasting with all other courses in the same year-level and/or program to identify students’ experiences: </li>
                                    <ul>
                                        <li>Is there a wide variety of assessment methods? </li>
                                        <li>Is there a wide variety of teaching and learning experiences? </li>
                                        <li>Are all learning outcomes clear and properly assessed? </li>
                                        <li>Are there gaps in content, skills, experiences that need to be addressed? </li>
                                    </ul>
                                    <li>A <strong>conversation at the department level</strong> with this information can yield excellent results for instructors and students! </li>
                                </ul>
                            </ul>
                            <br>
                            <h4>At the program level</h4>
                            <ul>
                                <li><strong>Before using the tool:</strong> Collect all relevant information to navigate the wizard: program learning outcomes (PLOs), program required and non-required courses </li>
                                <ul>
                                    <li>Each course can also be assigned to a collaborator to complete mapping at the course-level (not mandatory).</li>
                                    <li>If your program does not have PLOs, you may still use the tool with standard outcomes for an academic program.</li>
                                </ul>
                                <li>Once the tool produces a report with results, <strong>review, reflect,</strong> and take note of the program’s:</li>
                                <ul>
                                    <li>Strengths, weaknesses, areas for improvement.</li>
                                    <li>Share with other department colleagues to compare and contrast against other programs.</li>
                                    <li>Consider students’ learning and experiences throughout this program: </li>
                                    <ul>
                                        <li>Is there a wide variety of assessment methods? </li>
                                        <li>Is there a wide variety of teaching and learning experiences? </li>
                                        <li>Are all learning outcomes clear and properly assessed? </li>
                                        <li>Are there gaps in content, skills, experiences that need to be addressed? </li>
                                        <li>Are there signature pedagogies that can be better integrated into the program? </li>
                                    </ul>
                                    <li>A <strong>conversation at the department level</strong> with this information can yield excellent results for instructors and students! </li>
                                </ul>
                            </ul>
                            <br>
                            <h4>Alignment with Quality Assurance and Enhancement</h4>
                            <p>UBC Okanagan is committed to providing the highest quality of education to all students. This means ongoing work for continuous improvement and innovation of teaching and learning practices across disciplines.</p>
                            <p>This website aims to support this commitment by providing all instructors with a tool to ideate, create, and evaluate new or already existing courses and programs, using backward design. Engaging in this important exercise benefits students, instructors, and our overall communities. </p>
                            <p>To learn more about UBC Okanagan’s efforts towards quality assurance and enhancement <a href ="https://provost.ok.ubc.ca/initiatives/quality-assurance-and-enhancement/" alt="quality assurance and enhancement site">click here.</a> </p>
                        </div>
                    </details>
                </li>
                <li>
                    <details>
                        <summary><h3>Testimonials</h3></summary>
                        <div class= "summary-body">
                            <ul>
                                <li>From users</li>
                            </ul>
                        </div>
                    </details>
                </li>
                <li>
                    <details>
                        <summary><h3>FAQ</h3></summary>
                        <div class= "summary-body">
                            <ul>
                                <li>Can I use this mapping website if I don’t have all course details?</li>
                                <ul>
                                    <li>Yes, the minimum requirement to use this tool is a set of course learning outcomes or competencies. All other requested information is optional.</li>
                                </ul>
                                <li>Can I view how different courses map to different program learning outcomes? </li>
                                <ul>
                                    <li>Yes, you may map one course to as many sets of program-learning outcomes or competencies as you like.</li>
                                </ul>
                                <li>How do I retrieve a course or program that I deleted in the past? </li>
                                <ul>
                                    <li>Once you have deleted a course or a program, you are not able to retrieve it.</li>
                                </ul>
                                <li>Can somebody help me use this tool? </li>
                                <ul>
                                    <li>Yes, you may request support for course and program mapping from the Centre for Teaching and Learning or the Provost Office.</li>
                                </ul>
                            </ul>
                        </div>    
                    </details>
                </li>
                <li>
                    <details>
                        <summary><h3>References and Literature</h3></summary>
                        <div class= "summary-body">
                            <ul>
                                <li>Al-Eyd, G., et al. (2018). Curriculum mapping as a tool to facilitate curriculum development: a new School of Medicine experience, BMC Med. Educ., vol. 18, no. 1, p. 185 </li>
                                <li>Bick Har Lam & Kwok Tung Tsui (2016) Curriculum mapping as deliberation – examining the alignment of subject learning outcomes and course curricula, Studies in Higher Education, 41:8, 1371-1388, DOI: 10.1080/03075079.2014.968539 </li>
                                <li>Erickson, H. L. (2004). Foreword. In H. H. Jacobs (Ed.), Getting results with curriculum mapping (pp. i - ix). Alexandria, VA, USA: Association for Supervision & Curriculum Development. </li>
                                <li>I Khoerunnisa et al 2018 IOP Conf. Ser.: Mater. Sci. Eng. 434 012303</li>
                                <li>Kalu, F., & Dyjur, P. (2018). Creating a culture of continuous assessment to improve student learning through curriculum review. New Directions for Teaching and Learning, 2018(155), 47-54. https://doi.org/10.1002/tl.20302</li>
                                <li>Sumsion, Jennifer & Goodfellow, Joy. (2004).  Identifying generic skills through curriculum mapping: a critical evaluation, Higher Education Research &amp; Development, 23:3, 329-346, DOI: 10.1080/0729436042000235436 </li>
                                <li>Susan Gardner Archambault & Jennifer Masunaga (2015) Curriculum Mapping as a Strategic Planning Tool, Journal of Library Administration, 55:6, 503-519, DOI: 10.1080/01930826.2015.1054770 </li>
                                <li>Uchiyama, K.P., & Radin, Jean L. (2008). Curriculum mapping in higher education: A vehicle for collaboration, Innov High Educ (2009), 33:271-280, DOI: 10.1007/s10755-008-9078-8</li>
                                <li>Wijngaards-de Meij, Leoniek & Merx, Sigrid. (2018) Improving curriculum alignment and achieving learning goals by making the curriculum visible, International Journal for Academic Development, 23:3, 219-231, DOI: 10.1080/1360144X.2018.1462187 </li>
                            </ul>
                        </div>
                    </details>
                </li>  
                <li>
                    <details>
                        <summary><h3>Contributors</h3></summary>
                        <div class= "summary-body">
                            <ul>
                                <li>Funded by the UBC Okanagan Office of the Provost and Vice President Academic and supported by: </li>
                                <ul>
                                    <li>The UBC co-op program from Okanagan and Vancouver campuses. Programmers:</li>
                                    <ul>
                                        <li>Abdelmuizz Yusuf (Muizz)</li>
                                        <li>Jia Fei LuoZheng (Jeffrey)</li>
                                        <li>Kieran Adams</li>
                                        <li>Kanishka Verma</li>
                                    </ul>
                                    <li>Dr. Bowen Hui, Computer Science</li>
                                    <li>Dr. Anita Chaudhuri, English and Cultural Studies</li>
                                    <li>Janine Hirtz, Centre for Teaching and Learning</li>
                                    <li>Laura Prada, Office of the Provost and Vice President Academic</li>
                                </ul>
                            </ul>
                            <br>
                            <p>Inspired by and based on UCalgary’s tool: <a href="#">.</a></p>
                            <p class="lead">
                            If you have questions about the Curriculum Alignment Tool, please contact <a href="mailto:laura.prada@ubc.ca">laura.prada@ubc.ca</a> at the <a href="https://provost.ok.ubc.ca/" target="_blank">Office of the Provost and Vice-President Academic, UBC Okanagan campus</a>.
                            </p>
                        </div>
                    </details>
        </li>
            </ul>
        </div>
    </div>
</div>





<script>

</script>

<!-- End here -->
@endsection
