@extends('admin')

@section('head')
    <div class="col-sm-4">
        <h2>Project list</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                <strong>Project list</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>All projects assigned to this account</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal4">
                            Create new project
                        </button>
                        <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ajouter Categorie</h4>
                                        <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ibox-content">
                                            <form method="get" class="form-horizontal">
                                                <div class="form-group"><label class="col-sm-2 control-label">Normal</label>

                                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Help text</label>
                                                    <div class="col-sm-10"><input type="text" class="form-control"> <span class="help-block m-b-none">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Password</label>

                                                    <div class="col-sm-10"><input type="password" class="form-control" name="password"></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Placeholder</label>

                                                    <div class="col-sm-10"><input type="text" placeholder="placeholder" class="form-control"></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-lg-2 control-label">Disabled</label>

                                                    <div class="col-lg-10"><input type="text" disabled="" placeholder="Disabled input here..." class="form-control"></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-lg-2 control-label">Static control</label>

                                                    <div class="col-lg-10"><p class="form-control-static">email@example.com</p></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Checkboxes and radios <br/>
                                                        <small class="text-navy">Normal Bootstrap elements</small></label>

                                                    <div class="col-sm-10">
                                                        <div><label> <input type="checkbox" value=""> Option one is this and that&mdash;be sure to include why it's great </label></div>
                                                        <div><label> <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> Option one is this and that&mdash;be sure to
                                                                include why it's great </label></div>
                                                        <div><label> <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Option two can be something else and selecting it will
                                                                deselect option one </label></div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Inline checkboxes</label>

                                                    <div class="col-sm-10"><label class="checkbox-inline"> <input type="checkbox" value="option1" id="inlineCheckbox1"> a </label> <label class="checkbox-inline">
                                                            <input type="checkbox" value="option2" id="inlineCheckbox2"> b </label> <label class="checkbox-inline">
                                                            <input type="checkbox" value="option3" id="inlineCheckbox3"> c </label></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Checkboxes &amp; radios <br/><small class="text-navy">Custom elements</small></label>

                                                    <div class="col-sm-10">
                                                        <div class="i-checks"><label> <input type="checkbox" value=""> <i></i> Option one </label></div>
                                                        <div class="i-checks"><label> <input type="checkbox" value="" checked=""> <i></i> Option two checked </label></div>
                                                        <div class="i-checks"><label> <input type="checkbox" value="" disabled="" checked=""> <i></i> Option three checked and disabled </label></div>
                                                        <div class="i-checks"><label> <input type="checkbox" value="" disabled=""> <i></i> Option four disabled </label></div>
                                                        <div class="i-checks"><label> <input type="radio" value="option1" name="a"> <i></i> Option one </label></div>
                                                        <div class="i-checks"><label> <input type="radio" checked="" value="option2" name="a"> <i></i> Option two checked </label></div>
                                                        <div class="i-checks"><label> <input type="radio" disabled="" checked="" value="option2"> <i></i> Option three checked and disabled </label></div>
                                                        <div class="i-checks"><label> <input type="radio" disabled="" name="a"> <i></i> Option four disabled </label></div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Inline checkboxes</label>

                                                    <div class="col-sm-10"><label class="checkbox-inline i-checks"> <input type="checkbox" value="option1">a </label>
                                                        <label class="checkbox-inline i-checks"> <input type="checkbox" value="option2"> b </label>
                                                        <label class="checkbox-inline i-checks"> <input type="checkbox" value="option3"> c </label></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Select</label>

                                                    <div class="col-sm-10"><select class="form-control m-b" name="account">
                                                            <option>option 1</option>
                                                            <option>option 2</option>
                                                            <option>option 3</option>
                                                            <option>option 4</option>
                                                        </select>

                                                        <div class="col-lg-4 m-l-n"><select class="form-control" multiple="">
                                                                <option>option 1</option>
                                                                <option>option 2</option>
                                                                <option>option 3</option>
                                                                <option>option 4</option>
                                                            </select></div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group has-success"><label class="col-sm-2 control-label">Input with success</label>

                                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group has-warning"><label class="col-sm-2 control-label">Input with warning</label>

                                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group has-error"><label class="col-sm-2 control-label">Input with error</label>

                                                    <div class="col-sm-10"><input type="text" class="form-control"></div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Control sizing</label>

                                                    <div class="col-sm-10"><input type="text" placeholder=".input-lg" class="form-control input-lg m-b">
                                                        <input type="text" placeholder="Default input" class="form-control m-b"> <input type="text" placeholder=".input-sm" class="form-control input-sm">
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Column sizing</label>

                                                    <div class="col-sm-10">
                                                        <div class="row">
                                                            <div class="col-md-2"><input type="text" placeholder=".col-md-2" class="form-control"></div>
                                                            <div class="col-md-3"><input type="text" placeholder=".col-md-3" class="form-control"></div>
                                                            <div class="col-md-4"><input type="text" placeholder=".col-md-4" class="form-control"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Input groups</label>

                                                    <div class="col-sm-10">
                                                        <div class="input-group m-b"><span class="input-group-addon">@</span> <input type="text" placeholder="Username" class="form-control"></div>
                                                        <div class="input-group m-b"><input type="text" class="form-control"> <span class="input-group-addon">.00</span></div>
                                                        <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="text" class="form-control"> <span class="input-group-addon">.00</span></div>
                                                        <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control"></div>
                                                        <div class="input-group"><span class="input-group-addon"> <input type="radio"> </span> <input type="text" class="form-control"></div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Button addons</label>

                                                    <div class="col-sm-10">
                                                        <div class="input-group m-b"><span class="input-group-btn">
                                            <button type="button" class="btn btn-primary">Go!</button> </span> <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group"><input type="text" class="form-control"> <span class="input-group-btn"> <button type="button" class="btn btn-primary">Go!
                                        </button> </span></div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">With dropdowns</label>

                                                    <div class="col-sm-10">
                                                        <div class="input-group m-b">
                                                            <div class="input-group-btn">
                                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Action</a></li>
                                                                    <li><a href="#">Another action</a></li>
                                                                    <li><a href="#">Something else here</a></li>
                                                                    <li class="divider"></li>
                                                                    <li><a href="#">Separated link</a></li>
                                                                </ul>
                                                            </div>
                                                            <input type="text" class="form-control"></div>
                                                        <div class="input-group"><input type="text" class="form-control">

                                                            <div class="input-group-btn">
                                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <li><a href="#">Action</a></li>
                                                                    <li><a href="#">Another action</a></li>
                                                                    <li><a href="#">Something else here</a></li>
                                                                    <li class="divider"></li>
                                                                    <li><a href="#">Separated link</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group"><label class="col-sm-2 control-label">Segmented</label>

                                                    <div class="col-sm-10">
                                                        <div class="input-group m-b">
                                                            <div class="input-group-btn">
                                                                <button tabindex="-1" class="btn btn-white" type="button">Action</button>
                                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"><span class="caret"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Action</a></li>
                                                                    <li><a href="#">Another action</a></li>
                                                                    <li><a href="#">Something else here</a></li>
                                                                    <li class="divider"></li>
                                                                    <li><a href="#">Separated link</a></li>
                                                                </ul>
                                                            </div>
                                                            <input type="text" class="form-control"></div>
                                                        <div class="input-group"><input type="text" class="form-control">

                                                            <div class="input-group-btn">
                                                                <button tabindex="-1" class="btn btn-white" type="button">Action</button>
                                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"><span class="caret"></span></button>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <li><a href="#">Action</a></li>
                                                                    <li><a href="#">Another action</a></li>
                                                                    <li><a href="#">Something else here</a></li>
                                                                    <li class="divider"></li>
                                                                    <li><a href="#">Separated link</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <div class="col-sm-4 col-sm-offset-2">
                                                        <button class="btn btn-white" type="submit">Cancel</button>
                                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-1">
                            <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                        </div>
                    </div>

                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td class="project-status">
                                    <span class="label label-primary">Active</span>
                                </td>
                                <td class="project-title">
                                    <a href="project_detail.html">Contract with Zender Company</a>
                                    <br/>
                                    <small>Created 14.08.2014</small>
                                </td>
                                <td class="project-completion">
                                    <small>Completion with: 48%</small>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </td>
                                <td class="project-people">
                                    <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="img/a4.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                                </td>
                                <td class="project-actions">
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> مسح </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="project-status">
                                    <span class="label label-default">Unactive</span>
                                </td>
                                <td class="project-title">
                                    <a href="project_detail.html">Many desktop publishing packages and web</a>
                                    <br/>
                                    <small>Created 10.08.2014</small>
                                </td>
                                <td class="project-completion">
                                    <small>Completion with: 8%</small>
                                    <div class="progress progress-mini">
                                        <div style="width: 8%;" class="progress-bar"></div>
                                    </div>
                                </td>
                                <td class="project-people">
                                    <a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                </td>
                                <td class="project-actions">
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="project-status">
                                    <span class="label label-primary">Active</span>
                                </td>
                                <td class="project-title">
                                    <a href="project_detail.html">Letraset sheets containing</a>
                                    <br/>
                                    <small>Created 22.07.2014</small>
                                </td>
                                <td class="project-completion">
                                    <small>Completion with: 83%</small>
                                    <div class="progress progress-mini">
                                        <div style="width: 83%;" class="progress-bar"></div>
                                    </div>
                                </td>
                                <td class="project-people">
                                    <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="img/a7.jpg"></a>
                                </td>
                                <td class="project-actions">
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-trash"></i> Delete </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection