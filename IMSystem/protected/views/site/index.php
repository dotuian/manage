<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>


<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">学生信息管理</div>
                <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>Input Boxes</h6>
                    <hr />
                    <!-- Form starts.  -->
                    <form class="form-horizontal" role="form">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Input Box</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Input Box">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" placeholder="Password Box">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Textarea</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" rows="3" placeholder="Textarea"></textarea>
                            </div>
                        </div>    

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Checkbox</label>
                            <div class="col-lg-10">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> 1
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> 2
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox3" value="option3"> 3
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Radio Box</label>
                            <div class="col-lg-10">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                        Option one is this and that&mdash;be sure to include why it's great
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                        Option two can be something else and selecting it will deselect option one
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Select Box</label>
                            <div class="col-lg-10">
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>     

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Select Box</label>
                            <div class="col-lg-10">
                                <select multiple class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>   

                        <div class="form-group">
                            <label class="col-lg-2 control-label">CLEditor</label>
                            <div class="col-lg-10">
                                <textarea class="cleditor" name="input"></textarea>
                            </div>
                        </div>                                 

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <button type="button" class="btn btn-default">Default</button>
                                <button type="button" class="btn btn-primary">Primary</button>
                                <button type="button" class="btn btn-success">Success</button>
                                <button type="button" class="btn btn-info">Info</button>
                                <button type="button" class="btn btn-warning">Warning</button>
                                <button type="button" class="btn btn-danger">Danger</button>
                            </div>
                        </div>
                    </form>
                    <br><hr>
                    <div class="skin skin-minimal col-lg-offset-2">
                        <div class="skin-section">
                            <h3>Theme 1</h3><br>
                            <ul class="list col-lg-4">
                                <li>
                                    <input tabindex="5" type="checkbox" id="minimal-checkbox-1">
                                    <label for="minimal-checkbox-1">Checkbox 1</label>
                                </li>
                                <li>
                                    <input tabindex="6" type="checkbox" id="minimal-checkbox-2" checked>
                                    <label for="minimal-checkbox-2">Checkbox 2</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="minimal-checkbox-disabled" disabled>
                                    <label for="minimal-checkbox-disabled">Disabled</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="minimal-checkbox-disabled-checked" checked disabled>
                                    <label for="minimal-checkbox-disabled-checked">Disabled &amp; checked</label>
                                </li>
                            </ul>
                            <ul class="list col-lg-4">
                                <li>
                                    <input tabindex="7" type="radio" id="minimal-radio-1" name="minimal-radio">
                                    <label for="minimal-radio-1">Radio button 1</label>
                                </li>
                                <li>
                                    <input tabindex="8" type="radio" id="minimal-radio-2" name="minimal-radio" checked>
                                    <label for="minimal-radio-2">Radio button 2</label>
                                </li>
                                <li>
                                    <input type="radio" id="minimal-radio-disabled" disabled>
                                    <label for="minimal-radio-disabled">Disabled</label>
                                </li>
                                <li>
                                    <input type="radio" id="minimal-radio-disabled-checked" checked disabled>
                                    <label for="minimal-radio-disabled-checked">Disabled &amp; checked</label>
                                </li>
                            </ul>
                            <div class="colors clear">
                                <strong>Color schemes</strong>
                                <ul>
                                    <li class="active" title="Black"></li>
                                    <li class="red" title="Red"></li>
                                    <li class="green" title="Green"></li>
                                    <li class="blue" title="Blue"></li>
                                    <li class="aero" title="Aero"></li>
                                    <li class="grey" title="Grey"></li>
                                    <li class="orange" title="Orange"></li>
                                    <li class="yellow" title="Yellow"></li>
                                    <li class="pink" title="Pink"></li>
                                    <li class="purple" title="Purple"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br><hr>
                    <div class="skin skin-square col-lg-offset-2">
                        <div class="skin-section">
                            <h3>Theme 2</h3><br>
                            <ul class="list col-lg-4">
                                <li>
                                    <input tabindex="5" type="checkbox" id="minimal-checkbox-1">
                                    <label for="minimal-checkbox-1">Checkbox 1</label>
                                </li>
                                <li>
                                    <input tabindex="6" type="checkbox" id="minimal-checkbox-2" checked>
                                    <label for="minimal-checkbox-2">Checkbox 2</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="minimal-checkbox-disabled" disabled>
                                    <label for="minimal-checkbox-disabled">Disabled</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="minimal-checkbox-disabled-checked" checked disabled>
                                    <label for="minimal-checkbox-disabled-checked">Disabled &amp; checked</label>
                                </li>
                            </ul>
                            <ul class="list col-lg-4">
                                <li>
                                    <input tabindex="7" type="radio" id="minimal-radio-1" name="minimal-radio">
                                    <label for="minimal-radio-1">Radio button 1</label>
                                </li>
                                <li>
                                    <input tabindex="8" type="radio" id="minimal-radio-2" name="minimal-radio" checked>
                                    <label for="minimal-radio-2">Radio button 2</label>
                                </li>
                                <li>
                                    <input type="radio" id="minimal-radio-disabled" disabled>
                                    <label for="minimal-radio-disabled">Disabled</label>
                                </li>
                                <li>
                                    <input type="radio" id="minimal-radio-disabled-checked" checked disabled>
                                    <label for="minimal-radio-disabled-checked">Disabled &amp; checked</label>
                                </li>
                            </ul>
                            <div class="colors clear">
                                <strong>Color schemes</strong>
                                <ul>
                                    <li class="" title="Black"></li>
                                    <li class="red" title="Red"></li>
                                    <li class="green active" title="Green"></li>
                                    <li class="blue" title="Blue"></li>
                                    <li class="aero" title="Aero"></li>
                                    <li class="grey" title="Grey"></li>
                                    <li class="orange" title="Orange"></li>
                                    <li class="yellow" title="Yellow"></li>
                                    <li class="pink" title="Pink"></li>
                                    <li class="purple" title="Purple"></li>
                                </ul>
                            </div>
                        </div>
                    </div><br><hr>
                    <div class="skin skin-flat col-lg-offset-2">
                        <div class="skin-section">
                            <h3>Theme 3</h3><br>
                            <ul class="list col-lg-4">
                                <li>
                                    <input tabindex="5" type="checkbox" id="minimal-checkbox-1">
                                    <label for="minimal-checkbox-1">Checkbox 1</label>
                                </li>
                                <li>
                                    <input tabindex="6" type="checkbox" id="minimal-checkbox-2" checked>
                                    <label for="minimal-checkbox-2">Checkbox 2</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="minimal-checkbox-disabled" disabled>
                                    <label for="minimal-checkbox-disabled">Disabled</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="minimal-checkbox-disabled-checked" checked disabled>
                                    <label for="minimal-checkbox-disabled-checked">Disabled &amp; checked</label>
                                </li>
                            </ul>
                            <ul class="list col-lg-4">
                                <li>
                                    <input tabindex="7" type="radio" id="minimal-radio-1" name="minimal-radio">
                                    <label for="minimal-radio-1">Radio button 1</label>
                                </li>
                                <li>
                                    <input tabindex="8" type="radio" id="minimal-radio-2" name="minimal-radio" checked>
                                    <label for="minimal-radio-2">Radio button 2</label>
                                </li>
                                <li>
                                    <input type="radio" id="minimal-radio-disabled" disabled>
                                    <label for="minimal-radio-disabled">Disabled</label>
                                </li>
                                <li>
                                    <input type="radio" id="minimal-radio-disabled-checked" checked disabled>
                                    <label for="minimal-radio-disabled-checked">Disabled &amp; checked</label>
                                </li>
                            </ul>
                            <div class="colors clear">
                                <strong>Color schemes</strong>
                                <ul>
                                    <li class="" title="Black"></li>
                                    <li class="red active" title="Red"></li>
                                    <li class="green" title="Green"></li>
                                    <li class="blue" title="Blue"></li>
                                    <li class="aero" title="Aero"></li>
                                    <li class="grey" title="Grey"></li>
                                    <li class="orange" title="Orange"></li>
                                    <li class="yellow" title="Yellow"></li>
                                    <li class="pink" title="Pink"></li>
                                    <li class="purple" title="Purple"></li>
                                </ul>
                            </div>
                        </div>
                    </div><br><hr>
                    <div class="skin skin-line col-lg-offset-2">
                        <div class="skin-section">
                            <h3>Theme 4</h3><br>
                            <ul class="list col-lg-2">
                                <li>
                                    <input tabindex="5" type="checkbox" id="minimal-checkbox-1">
                                    <label for="minimal-checkbox-1">Checkbox 1</label>
                                </li>
                                <li>
                                    <input tabindex="6" type="checkbox" id="minimal-checkbox-2" checked>
                                    <label for="minimal-checkbox-2">Checkbox 2</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="minimal-checkbox-disabled" disabled>
                                    <label for="minimal-checkbox-disabled">Disabled</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="minimal-checkbox-disabled-checked" checked disabled>
                                    <label for="minimal-checkbox-disabled-checked">Disabled &amp; checked</label>
                                </li>
                            </ul>
                            <ul class="list col-lg-2">
                                <li>
                                    <input tabindex="7" type="radio" id="minimal-radio-1" name="minimal-radio">
                                    <label for="minimal-radio-1">Radio button 1</label>
                                </li>
                                <li>
                                    <input tabindex="8" type="radio" id="minimal-radio-2" name="minimal-radio" checked>
                                    <label for="minimal-radio-2">Radio button 2</label>
                                </li>
                                <li>
                                    <input type="radio" id="minimal-radio-disabled" disabled>
                                    <label for="minimal-radio-disabled">Disabled</label>
                                </li>
                                <li>
                                    <input type="radio" id="minimal-radio-disabled-checked" checked disabled>
                                    <label for="minimal-radio-disabled-checked">Disabled &amp; checked</label>
                                </li>
                            </ul>
                            <div class="colors clear">
                                <strong>Color schemes</strong>
                                <ul>
                                    <li class="" title="Black"></li>
                                    <li class="red" title="Red"></li>
                                    <li class="green" title="Green"></li>
                                    <li class="blue active" title="Blue"></li>
                                    <li class="aero" title="Aero"></li>
                                    <li class="grey" title="Grey"></li>
                                    <li class="orange" title="Orange"></li>
                                    <li class="yellow" title="Yellow"></li>
                                    <li class="pink" title="Pink"></li>
                                    <li class="purple" title="Purple"></li>
                                </ul>
                            </div>
                        </div>
                    </div><br>
                </div>
            </div>
        </div>  

    </div>
</div>



<!--
<div class="row">
    <div class="col-md-6">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">Styled Checkboxes & Radio Buttons</div>
                <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-content">
                <div class="padd">
                    <form role="form" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputDate" class="col-lg-4 control-label">
                                Date
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="inputDate" id="inputDate" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPhone" class="col-lg-4 control-label">
                                Phone
                            </label>
                            <div class="col-lg-8">
                                <input type="tel" name="inputPhone" id="inputPhone" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPhoneExit" class="col-lg-4 control-label">
                                Phone and Exit
                            </label>
                            <div class="col-lg-8">
                                <input type="tel" name="inputPhoneExit" id="inputPhoneExit" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputIntPhone" class="col-lg-4 control-label">
                                Int Phone
                            </label>
                            <div class="col-lg-8">
                                <input type="tel" name="inputIntPhone" id="inputIntPhone" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputTaxID" class="col-lg-4 control-label">
                                Tax ID
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="inputTaxID" id="inputTaxID" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSSN" class="col-lg-4 control-label">
                                SSN
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="inputSSN" id="inputSSN" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputProductKey" class="col-lg-4 control-label">
                                Product Key
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="inputProductKey" id="inputProductKey" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEyeScript" class="col-lg-4 control-label">
                                Eye Script
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="inputEyeScript" id="inputEyeScript" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPurchaseOrder" class="col-lg-4 control-label">
                                Purchase Order
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="inputPurchaseOrder" id="inputPurchaseOrder" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPercent" class="col-lg-4 control-label">
                                Percent
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="inputPercent" id="inputPercent" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>    
        </div>   
    </div>
    <div class="col-md-6">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">Dropzone Upload</div>
                <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-content">
                <div class="padd">
                    <form action="/file-upload" class="dropzone">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </form>
                </div>
            </div>    
        </div>   
    </div>
</div>


<div class="row">
    <div class="col-md-9">
        <div class="widget">

            <div class="widget-head">
                <div class="pull-left">Form Validation</div>
                <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a>  
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <form action="/" class="validate" id='form1'>
                        <fieldset>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="validate[required] form-control placeholder" id="personName" placeholder="Your name" data-bind="value: name" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="validate[required,custom[email]] form-control placeholder" id="personEmail" placeholder="Your email" data-original-title="Your activation email will be sent to this address." data-bind="value: email, event: { change: checkDuplicateEmail }" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="validate[required] form-control placeholder" id="password" placeholder="Password" data-bind="value: password" />
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Repeat Password</label>
                                <input type="password" class="validate[required,equals[password]] form-control placeholder" id="repeatPassword" placeholder="Repeat password" data-bind="value: confirmPassword, event: { change: matchPassword }" />
                            </div>
                            <div class="form-group">
                                <label for="companyName">Company Name</label>
                                <input type="text" class="validate[required] form-control placeholder" id="companyName" placeholder="Your company name" data-bind="value: company" />
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select class="validate[required] form-control placeholder" id="country" data-bind="options: availableCountries, value: selectedCountry, optionsCaption: 'Country'">
                                    <option value>Choose</option>
                                    <option value="1">list 1</option>
                                    <option value="2">list 2</option>
                                </select>
                            </div>
                            <button id="signupuser" type="submit" class="btn btn-primary btn-block">Create Free Account</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

-->