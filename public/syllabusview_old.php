<?php $page_name = "Manage Syllabus" ?>
<?php include("head.php"); ?>
    
    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">
    
    <!-- Go To Top CSS -->
    <style>
    #top-link-block.affix-top {
        position: absolute; /* allows it to "slide" up into view */
        bottom: -88px;
        right: 10px;
    }
    #top-link-block.affix {
        position: fixed; /* keeps it on the bottom once in view */
        bottom: 12px;
        right: 10px;
    }
    </style>
<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<!-- Check query parameters -->
<?php 
  
  $query_params = checkQueryParams(array("section"));
  if($query_params["cnt"] < 1) {
    redirectTo("syllabusmanage.php");
  }  
?>

<!-- Sub Navbar for Syllabus -->
<nav class="navbar navbar-inverse navbar-fixed-bottom">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo $query_params["section"];?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!-- <ul class="nav navbar-nav">
         <li><a href="#">Link</a></li> 
      </ul>-->  
      
      <ul class="nav navbar-nav navbar-right">
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li>
          <a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
            Back To Top <span class="caret"></span>            
          </a>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



  
<!-- Go To Top Button
<a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
    <button type="button" id="top-link-block" class="btn btn-primary btn-circle btn-lg hidden"><i class="fa fa-chevron-circle-up"></i></button>
</a>  /top-link-block -->
  

<div id="page-wrapper">
	<div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><?php echo $page_name?></h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->	



	

  <!-- Overview-->
  <div class="panel panel-warning">
    <div class="panel-heading">
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gear"></i> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="syllabusview.php?section=<?php echo $sections["SECTION"];?>"><i class="fa fa-list-alt"></i> Manage Syllabus</a></li>
            <li><a href="#"><i class="fa fa-copy"></i> Replicate</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
          </ul>
        </div>
        <h4>Overview</h4>
    </div>
    <div class="panel-body">
      
      
      <!-- /.row -->
      <div class="row">
          <div class="col-lg-8">
              
              <div class="panel panel-default">    
                  <div class="panel-heading">
                      <b>Course Overview</b>
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                      <div class="table">
                          <table class="table table-bordered table-hover">
                              <tbody>
                                  <tr>
                                      <td>Course Section:</td>
                                      <td>OL</td>
                                  </tr>
                                  <tr>
                                      <td>Class Schedule:</td>
                                      <td>Online</td>
                                      
                                  </tr>
                                  <tr>
                                      <td>Quarter:</td>
                                      <td>Q1, 2015</td>
                                  </tr>
                                  <tr>
                                      <td class="text-nowrap">Number of Credits:</td>
                                      <td>1 total credits</td>
                                  </tr>
                                  <tr>
                                      <td>Prerequisite(s):</td>
                                      <td>Approval of the advisor and completion of 18 additional credits earned towards a graduate degree in the School of Computer Information Systems.</td>
                                  </tr>

                                  <tr>
                                      <td>Cancellation #:</td>
                                      <td>703-821-8570</td>
                                  </tr>
                                 
                              </tbody>
                          </table>
                      </div>
                      <!-- /.table-responsive -->
                  </div>
                  <!-- /.panel-body -->
              </div>
              <!-- /.panel -->
             
              
          </div>
          <!-- /.col-lg-8 -->
          <div class="col-lg-4">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <i class="fa fa-user fa-fw"></i> Instructor
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                      <div class="list-group">
                          <a href="#" class="list-group-item">
                              <span class="lead">Umair Mazhar</span>
                          </a>
                          <a href="#" class="list-group-item">
                              umazhar@stratford.edu
                              <span class="pull-right text-muted small"><em>Email</em>
                              </span>
                          </a>
                          <a href="#" class="list-group-item">
                              By appointment
                              <span class="pull-right text-muted small"><em>Office Hours</em>
                              </span>
                          </a>
                          <a href="#" class="list-group-item">
                              Online
                              <span class="pull-right text-muted small"><em>Office Location</em>
                              </span>
                          </a>
                          <a href="#" class="list-group-item">
                              240-751-8129
                              <span class="pull-right text-muted small"><em>Office Phone</em>
                              </span>
                          </a>
                          <a href="#" class="list-group-item">
                              240-751-8129
                              <span class="pull-right text-muted small"><em>Phone</em>
                              </span>
                          </a>
                       
                      </div>
                      <!-- /.list-group -->
                      
                  </div>
                  <!-- /.panel-body -->
              </div>
              <!-- /.panel -->
              
          </div>
          <!-- /.col-lg-4 -->
      </div>
      <!-- /.row -->

    </div> <!-- /.panel-body -->
  </div>

  <!-- Course / Course Description -->
  <div class="panel panel-warning">
    <div class="panel-heading">
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gear"></i> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="syllabusview.php?section=<?php echo $sections["SECTION"];?>"><i class="fa fa-list-alt"></i> Manage Syllabus</a></li>
            <li><a href="#"><i class="fa fa-copy"></i> Replicate</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
          </ul>
        </div>
        <h4>Course / Course Description</h4>
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
                Cooperative education allows students to combine academic study with on-the-job experience by working on paid training assignments coordinated and approved by Departmental Faculty. Upon completion of this course, students will be able to apply theory to practice by demonstrating program learning outcomes in real work environments.
            </div>
    </div>
  </div>

  <!-- Course / Course Objective -->
  <div class="panel panel-warning">
    <div class="panel-heading">
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gear"></i> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="syllabusview.php?section=<?php echo $sections["SECTION"];?>"><i class="fa fa-list-alt"></i> Manage Syllabus</a></li>
            <li><a href="#"><i class="fa fa-copy"></i> Replicate</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
          </ul>
        </div>
        <h4>Course / Course Course Objective</h4>
    </div>
    <div class="panel-body">
        <div class="col-lg-12">
            Upon completion of this course, the student will be able to:
            <ul>
                <li>Apply computer information systems principles and practices in real-world settings.</li>
                <li>Develop interpersonal and professional skills appropriate for work settings.</li>
                <li>Demonstrate effective verbal and written communication skills.</li>
                <li>Apply critical thinking to analyze and solve real world problems.</li>
                <li>Assess the organizational structure, behaviors and functions within the CIS profession.</li>
            </ul>               
        </div>
    </div>
  </div>

  <!-- Course / Instruction Methods -->
  <div class="panel panel-warning">
    <div class="panel-heading">
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gear"></i> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="syllabusview.php?section=<?php echo $sections["SECTION"];?>"><i class="fa fa-list-alt"></i> Manage Syllabus</a></li>
            <li><a href="#"><i class="fa fa-copy"></i> Replicate</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
          </ul>
        </div>
        <h4>Course / Instruction Methods</h4>
    </div>
    <div class="panel-body">
        
        
        <div class="row">
            <div class="col-lg-12">
                <p>CIS502 Cooperative Education III-- Computer Information Systems will meet for: <br/><br/></p>

            </div>
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-blackboard fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">0</div>
                                <div>Contact Hours</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <span class="pull-left">Lectures</span>
                        <div class="clearfix"></div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-flask fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">0</div>
                                <div>Contact Hours</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <span class="pull-left">Lab</span>
                        <div class="clearfix"></div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-desktop fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">30</div>
                                <div>Clinical Hours</div>
                            </div>
                        </div>
                    </div>
                
                    <div class="panel-footer">
                        <span class="pull-left">Externship</span>
                        <div class="clearfix"></div>
                    </div>
            
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">0</div>
                                <div>Contact Hours</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <span class="pull-left">Threaded Discussion</span>
                        <div class="clearfix"></div>
                    </div>
                
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <p>Stratford University courses are delivered in three formats: hybrid education, distance education, and externships/clinicals. Hybrid education courses are comprised of face-to-face lecture and/or lab and threaded discussion contact hours. Distance education courses consist of online lecture and/or lab and threaded discussion contact hours. Threaded discussion contact hours are dedicated to student-to-student, student-to-faculty, and student-to-content interaction to demonstrate critical thinking and are always delivered online via the Learning Management System (LMS), Moodle. Threaded discussion contact hours take a minimum of one hour per week and are not homework assignments. Ten hours of threaded discussion contact hours are equivalent to one credit hour. Externship/clinical courses take place outside the classroom and do not require threaded discussion contact hours. </p>

            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <nav>
                  <ul class="pager">
                    <li class="previous"><a href="course_objective.php"><span aria-hidden="true">&larr;</span> Previous</a></li>
                    <li class="next"><a href="tr_textbook.php">Next <span aria-hidden="true">&rarr;</span></a></li>
                  </ul>
                </nav>
            </div>
        </div>
        <!-- /.row -->
    </div>
  </div>

  <!-- Text Book & Resources -->
  <div class="panel panel-warning">
    <div class="panel-heading">
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gear"></i> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="syllabusview.php?section=<?php echo $sections["SECTION"];?>"><i class="fa fa-list-alt"></i> Manage Syllabus</a></li>
            <li><a href="#"><i class="fa fa-copy"></i> Replicate</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
          </ul>
        </div>
        <h4>Textbook &amp; Resources</h4>
    </div>
    <div class="panel-body">
        <?php
        
            
            
            

            // Google Books - Search by ISBN
            $api_url="https://www.googleapis.com/books/v1/volumes?q=isbn:9780763717612";

            $json_file = file_get_contents($api_url);
            //$json = json_encode($json_file);
            $array = json_decode($json_file,TRUE);
            
            if ($array["totalItems"] > 0){

                $bookitem = $array["items"][0]["volumeInfo"];
            }    
            ?>   



        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div>
                            <div>
                                Required Textbook
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-body">
                        <?php if ($array["totalItems"] > 0){ ?>
                        <div class="col-lg-2 text-center">
                                <br/>
                                <?php if ($array["totalItems"] > 0){
                                    if (array_key_exists("imageLinks", $bookitem)){
                                       echo "<img class='img-thumbnail' src=" . $bookitem["imageLinks"]["smallThumbnail"] . "/>";
                                    }
                                }?>
                            <div class="clearfix"></div>
                        </div>

                        <div class="col-lg-10">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="list-group">
                                        
                                            <a href="#" class="list-group-item ">
                                                <span class="lead"><?php echo $bookitem["title"];?></span>
                                            </a>
                                        
                                            <a href="#" class="list-group-item">
                                                <?php
                                                    foreach($bookitem["authors"] as $auth){
                                                        echo $auth . " ";
                                                    }
                                                ?>
                                                <span class="pull-right text-muted small"><em>Author</em>
                                                </span>
                                            </a>
                                            <a href="#" class="list-group-item">
                                                <?php
                                                    if (array_key_exists("publisher", $bookitem)){
                                                        echo $bookitem["publisher"];
                                                    }
                                                ?>
                                                <span class="pull-right text-muted small"><em>Publisher</em>
                                                </span>
                                            </a>
                                            <a href="#" class="list-group-item">
                                                <?php
                                                    if (array_key_exists("publishedDate", $bookitem)){
                                                        echo $bookitem["publishedDate"];
                                                    }
                                                ?>
                                                <span class="pull-right text-muted small"><em>Published Date</em>
                                                </span>
                                            </a>
                                            <a href="#" class="list-group-item">
                                                <?php
                                                if (array_key_exists("pageCount", $bookitem)){
                                                    echo $bookitem["pageCount"] . " pages";
                                                }
                                                ?>
                                                <span class="pull-right text-muted small"><em>Page Count</em>
                                                </span>
                                            </a>
                                            
                                            <a href="#" class="list-group-item">
                                                <?php 
                                                    if (array_key_exists("categories", $bookitem)){
                                                        foreach($bookitem["categories"] as $cat){
                                                            echo $cat . " ";
                                                        }
                                                    }
                                                ?>
                                                <span class="pull-right text-muted small"><em>Category</em>
                                                </span>
                                            </a>
                                         
                                        </div>
                                        <!-- /.list-group -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <?php } ?>
                                <!-- /.panel -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <p>Selected handouts and other materials to be distributed in class.</p>

            </div>
        </div>
        <!-- /.row -->
    </div>
  </div>

  <!-- Course Outline / Lesson Plan -->
  <div class="panel panel-warning">
    <div class="panel-heading">
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gear"></i> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="syllabusview.php?section=<?php echo $sections["SECTION"];?>"><i class="fa fa-list-alt"></i> Manage Syllabus</a></li>
            <li><a href="#"><i class="fa fa-copy"></i> Replicate</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
          </ul>
        </div>
        <h4>Course Outline / Lesson Plan</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-clock-o fa-fw"></i> Weekly Schedule
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <ul class="timeline">
                            <li>
                                <div class="timeline-badge warning"><i class="fa fa-play fw"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Week 1</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-list"></i> Topics Covered</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <ul>
                                            <li>Cooperative Education Proposal Submission</li>
                                            <li>Introduction</li>
                                            <li>Submit a summary of work related activities.</li>
                                                <ul><li>Students should also indicate how courses at Stratford relate to the work they are doing.</li></ul>
                                            <li>Respond to at least one other student’s weekly post</li>
                                            <li>Respond to Professor’s posted questions</li>
                                        </ul>
                                        <hr/>
                                        <p><small class="text-muted"><i class="fa fa-pencil-square-o"></i> Homework</small></p>
                                        <p>Moodle Participation, Deliverable #1 Due, Weekly Report 1 FORUM</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge">2</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Week 2</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-list"></i> Topics Covered</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge">3</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Week 3</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-list"></i> Topics Covered</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge">4</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Week 4</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-list"></i> Topics Covered</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates est quaerat asperiores sapiente, eligendi, nihil. Itaque quos, alias sapiente rerum quas odit! Aperiam officiis quidem delectus libero, omnis ut debitis!</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge danger"><i class="glyphicon glyphicon-education"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Week 5</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-list"></i> Topics Covered</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae consequuntur impedit nulla qui! Laborum, atque.</p>
                                        <hr/>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-education"></i> Mid-term Exam</small>
                                        </p>
                                        
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge">6</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Week 6</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-list"></i> Topics Covered</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam. Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge">7</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Week 7</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-list"></i> Topics Covered</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt obcaecati, quaerat tempore officia voluptas debitis consectetur culpa amet, accusamus dolorum fugiat, animi dicta aperiam, enim incidunt quisquam maxime neque eaque.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge">8</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Week 8</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-list"></i> Topics Covered</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam. Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge">9</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Week 9</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-list"></i> Topics Covered</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt obcaecati, quaerat tempore officia voluptas debitis consectetur culpa amet, accusamus dolorum fugiat, animi dicta aperiam, enim incidunt quisquam maxime neque eaque.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge success"><i class="glyphicon glyphicon-education"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Week 10</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-list"></i> Topics Covered</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam. Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
                                        <hr/>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-education"></i> Final Exam</small>
                                        </p>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>   
    </div>
  </div>










  <!-- Sample Panel -->
  <div class="panel panel-warning">
    <div class="panel-heading">
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gear"></i> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="syllabusview.php?section=<?php echo $sections["SECTION"];?>"><i class="fa fa-list-alt"></i> Manage Syllabus</a></li>
            <li><a href="#"><i class="fa fa-copy"></i> Replicate</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
          </ul>
        </div>
        <h4>Sample Panel</h4>
    </div>
    <div class="panel-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
    </div>
  </div>
  

</div> <!-- /.page-wrapper -->



<?php include("footer.php"); ?>

<script>
// Only enable if the document has a long scroll bar
// Note the window height + offset
 if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
 }
</script>