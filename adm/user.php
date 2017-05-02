
    	<div class="title"><h5>Form elements</h5></div>
        
        <!-- Statistics --> 
        <div class="stats">
        	<ul>
            	<li><a href="#" class="count grey" title="">52</a><span>new pending tasks</span></li>
                
                <li><a href="#" class="count grey" title="">520</a><span>pending orders</span></li>
                <li><a href="#" class="count grey" title="">14</a><span>new opened tickets</span></li>
                <li class="last"><a href="#" class="count grey" title="">48</a><span>new user registrations</span></li>
            </ul>
            <div class="fix"></div>
        </div>
        
        <!-- Form begins -->
        <form action="" class="mainForm">
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5 class="iList">Text fields</h5></div>
                        <div class="rowElem noborder"><label>Usual input text:</label><div class="formRight"><input type="text" name="inputtext"/></div><div class="fix"></div></div>
                        <div class="rowElem"><label>Input password:</label><div class="formRight"><input type="password" /></div><div class="fix"></div></div>
                        <div class="rowElem"><label>Input with placeholder:</label><div class="formRight"><input type="text" name="inputtext" placeholder="enter your placeholder text here"/></div><div class="fix"></div></div>
                        <div class="rowElem"><label>Input with autofocus:</label><div class="formRight"><input type="text" name="inputtext" class="autoF"/></div><div class="fix"></div></div>
                        <div class="rowElem"><label>Read only field:</label><div class="formRight"><input type="text" readonly="readonly" value="Read only text goes here" name="inputtext"/></div><div class="fix"></div></div>
                        <div class="rowElem"><label>Input with tooltip:</label><div class="formRight"><input type="text" name="inputtext" class="rightDir" title="Cool, huh?" /></div><div class="fix"></div></div>
                        <div class="rowElem"><label>Disabled input field:</label><div class="formRight"><input type="text" disabled="disabled" value="Disabled field" name="inputtext"/></div><div class="fix"></div></div>
                        <div class="rowElem"><label>With predefined value:</label><div class="formRight"><input type="text" value="http://" name="inputtext"/></div><div class="fix"></div></div>
                        <div class="rowElem"><label>With max length:</label><div class="formRight"><input type="text" maxlength="20" placeholder="max 20 characters here" name="inputtext"/></div><div class="fix"></div></div>
              
                        <div class="rowElem"><label>Usual textarea:</label><div class="formRight"><textarea rows="8" cols="" name="textarea"></textarea></div><div class="fix"></div></div>
                        <div class="rowElem"><label>Autogrowing textarea:</label><div class="formRight"><textarea rows="8" cols="" class="auto" name="textarea"></textarea></div><div class="fix"></div></div>
                        <input type="submit" value="Submit form" class="greyishBtn submitForm" />
                        <div class="fix"></div>

                </div>
            </fieldset>
            
            <!-- Filtering data rows -->
            <fieldset>
                <div class="widget">
                    <div class="head"><h5 class="iView">Filtering data rows</h5></div>
                    <div class="rowElem noborder">
                        <label>Simple data row :</label> 
                        <div class="formRight moreFields">
                            <ul class="rowData">
                                <li><input type="text" name="test" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="test" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="test" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="test" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="test" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="test" maxlength="6" /></li>
                                <li><span>All characters</span></li>
                            </ul>  
                        </div> 
                        <div class="fix"></div>   
                    </div>
                    
                    <div class="rowElem">
                        <label>Numbers only</label> 
                        <div class="formRight moreFields onlyNums">
                            <ul>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li><span>class="onlyNums"</span></li>
                            </ul>  
                        </div> 
                        <div class="fix"></div>   
                    </div>
    
                    <div class="rowElem">
                        <label>Letters only</label> 
                        <div class="formRight moreFields onlyText">
                            <ul>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li><span>class="onlyText"</span></li>
                            </ul>  
                        </div> 
                        <div class="fix"></div>   
                    </div>
                    
                    <div class="rowElem">
                        <label>Alpha only</label> 
                        <div class="formRight moreFields onlyAlpha">
                            <ul>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li><span>class="onlyAlpha"</span></li>
                            </ul>  
                        </div> 
                        <div class="fix"></div>   
                    </div>
    
                    <div class="rowElem">
                        <label>Regular expressions</label> 
                        <div class="formRight moreFields onlyRegex">
                            <ul>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="question" maxlength="6" /></li>
                                <li><span>class="onlyRegex"</span></li>
                            </ul>  
                        </div> 
                        <div class="fix"></div>   
                    </div>
                    
                    <div class="rowElem">
                        <label>Uppercase converting</label> 
                        <div class="formRight moreFields allUpper">
                            <ul>
                                <li><input type="text" name="up1" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="up2" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="up3" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="up4" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="up5" maxlength="6" /></li>
                                <li class="sep">-</li>
                                <li><input type="text" name="up6" maxlength="6" /></li>
                                <li><span>class="allUpper"</span></li>
                            </ul>  
                        </div> 
                        <div class="fix"></div>   
                    </div>
                </div>   
            </fieldset>
            
            <!-- Dropdowns and selects -->
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iCoverflow">Drowpdowns and selects</h5></div>
                
                    <div class="rowElem noborder">
                        <label>Select without scroll :</label>
                        <div class="formRight">                        
                            <select name="select">
                                <option value="">1</option>
                                <option value="opt1">2</option>
                            </select>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Select with scrolling :</label>
                        <div class="formRight">
                        <select name="select2" >
                            <option value="opt1">Usual select with scrolling</option>
                            <option value="opt2">Option 2</option>
                            <option value="opt3">Option 3</option>
                            <option value="opt4">Option 4</option>
                            <option value="opt5">Option 5</option>
                            <option value="opt6">Option 6</option>
                            <option value="opt7">Option 7</option>
                            <option value="opt8">Option 8</option>
                        </select>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Usual multiple select :</label>
                        <div class="formRight">
                            
                            <select multiple="multiple" class="multiple" title="Click to Select a City">
                            <option selected="selected">Amsterdam</option>      
                            <option selected="selected">Atlanta</option>
                            <option>Baltimore</option>
                            <option>Boston</option>
                            <option>Buenos Aires</option>
                            <option>Calgary</option>
                            <option selected="selected">Chicago</option>
                            <option>Denver</option>
                            <option>Dubai</option>
                            <option>Frankfurt</option>
                            <option>Hong Kong</option>
                            <option>Honolulu</option>
                            <option>Houston</option>
                            <option>Kuala Lumpur</option>
                            <option>London</option>
                            <option>Los Angeles</option>
                            <option>Melbourne</option>
                            <option>Mexico City</option>
                            <option>Miami</option>
                            <option>Minneapolis</option>
                            <option>Montreal</option>
                            <option>New York City</option>
                            <option>Paris</option>
                            <option>Philadelphia</option>
                            <option>Rotterdam</option>
                            <option>San Diego</option>
                            <option>San Francisco</option>
                            <option>Sao Paulo</option>
                            <option>Seattle</option>
                            <option>Seoul</option>
                            <option>Shanghai</option>
                            <option>Singapore</option>
                            <option>Sydney</option>
                            <option>Tokyo</option>
                            <option>Toronto</option>
                            <option>Vancouver</option>
                            </select>
                            
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem"><label>Simple numbers input:</label><div class="formRight"><input type="text" id="s1" value="10" /></div><div class="fix"></div></div>
                    <div class="rowElem"><label>Decimal:</label><div class="formRight"><input type="text" id="s2" value="10.25" /></div><div class="fix"></div></div>
                    <div class="rowElem"><label>Currency:</label><div class="formRight"><input type="text" id="s3" /></div><div class="fix"></div></div>
                    <div class="rowElem"><label>Inline data:</label>
                        <div class="formRight">
                            <ul id="s4">
                                <li>item 1</li>
                                <li>item 2</li>
                                <li>item 3</li>
                                <li>item 4</li>
                                <li>item 5</li>
                                <li>item 6</li>
                                <li>item 7</li>
                                <li>item 8</li>
                                <li>item 9</li>
                                <li>item 10</li>
                            </ul>
                        </div>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem"><label>Inline data (links):</label><div class="formRight"><div id="s5"></div></div><div class="fix"></div></div>
                </div>
            </fieldset>
            
            <!-- Checkboxes and radios -->
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iRecord">Checkbox and radio</h5></div>
                    <div class="rowElem noborder">
                        <label>Checkbox: </label>
                        <div class="formRight">
                            <input type="checkbox" id="check1" name="chbox" checked="checked" /><label>Checkbox checked</label>
                            <input type="checkbox" id="check2" name="chbox" /><label>Checkbox</label>
                            <input type="checkbox" id="check3" disabled="disabled" name="chbox" /><label class="itemDisabled">Disabled</label>
                            <input type="checkbox" id="check4" disabled="disabled" checked="checked" name="chbox" /><label class="itemDisabled">Disabled checked</label>
                        </div>
                        <div class="fix"></div>
                    </div>
                                        
                    <div class="rowElem">
                        <label>Radio :</label> 
                        <div class="formRight">
                            <input type="radio" name="question1" checked="checked" /><label>Selected radio</label>
                            <input type="radio" name="question1" /><label>Normal state</label>
                            <input type="radio" name="question" disabled="disabled" /><label class="itemDisabled">Disabled</label>
                            <input type="radio" name="question" disabled="disabled" checked="checked" /><label class="itemDisabled">Disabled checked</label>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                </div>
            </fieldset>
            
            <!-- File upload -->
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iUpload">File upload</h5></div>
                    <div id="uploader">You browser doesn't have HTML 4 support.</div>                    
                </div>
            </fieldset>
            
            <!-- WYSIWYG editor -->
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iPencil">WYSIWYG editor</h5></div>
                    <textarea class="wysiwyg" rows="5" cols=""></textarea>                
                </div>
            </fieldset>
        </form>
        
        <!-- Form with validation -->
        <form action="" id="valid" class="mainForm">
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iLocked2">Validation</h5></div>
                    <div class="rowElem noborder">
                        <label>Usual required field:</label>
                        <div class="formRight">
                            <input type="text" class="validate[required]" name="req" id="req"/>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Enter password:</label>
                        <div class="formRight">
                            <input type="password" class="validate[required,equals[password]]" name="password" id="password1" />
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Repeat password:</label>
                        <div class="formRight">
                            <input type="password" class="validate[required,equals[password]]" name="password" id="password2" />
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Minimum field size:</label>
                        <div class="formRight">
                            <input type="text" class="validate[required,minSize[6]]" name="minValid" id="minValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Maximum field size:</label>
                        <div class="formRight">
                            <input type="text" class="validate[required,maxSize[6]]" value="0123456789" name="maxValid" id="maxValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>integer >= -5:</label>
                        <div class="formRight">
                            <input type="text" value="-10" class="validate[required,custom[integer],min[-5]]" name="intValid" id="intValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>
          
                    <div class="rowElem">
                        <label>Maximum value:</label>
                        <div class="formRight">
                            <input type="text" value="55" class="validate[required,custom[integer],max[50]]" name="maxfieldValid" id="maxfieldValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Only letters:</label>
                        <div class="formRight">
                            <input type="text" value="this is an invalid char '.'" class="validate[required,custom[onlyLetterSp]]" name="lettersValid" id="lettersValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Only numbers and space:</label>
                        <div class="formRight">
                            <input type="text" value="10.1" class="validate[required,custom[onlyNumberSp]]" name="numsValid" id="numsValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Only [0-9a-zA-Z]:</label>
                        <div class="formRight">
                            <input type="text" value="too many spaces obviously" class="validate[required,custom[onlyLetterNumber]]" name="regexValid" id="regexValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>IP address:</label>
                        <div class="formRight">
                            <input type="text" value="192.168.3." class="validate[required,custom[ipv4]]" name="ipValid" id="ipValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Email address:</label>
                        <div class="formRight">
                            <input type="text" value="" class="validate[required,custom[email]]" name="emailValid" id="emailValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Date validation:</label>
                        <div class="formRight">
                            <input type="text" value="2009/06/30" class="validate[custom[date],past[2010/01/01]]" name="dateValid" id="dateValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem">
                        <label>Date format:</label>
                        <div class="formRight">
                            <input type="text" value="2011-01-" class="validate[custom[date],future[NOW]]" name="dateformatValid" id="dateformatValid"/>
                        </div>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem">
                        <label>Required textarea:</label>
                        <div class="formRight">
                            <textarea rows="8" cols="" name="textarea" class="validate[required]" id="textareaValid"></textarea>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    <input type="submit" value="Submit form" class="greyishBtn submitForm" />
                    <div class="fix"></div>
                        
                </div>
            </fieldset>
        </form>   
        
        <!-- Form -->
        <form action="" class="mainForm">
        
        	<!-- Another version of text inputs -->
            <fieldset>
                <div class="widget">
                    <div class="head"><h5 class="iList">Form. One more version</h5></div>
                    <div class="rowElem noborder"><label class="topLabel">Usual input text:</label><div class="formBottom"><input type="text" name="inputtext"/></div><div class="fix"></div></div>
                    <div class="rowElem"><label class="topLabel">Input password:</label><div class="formBottom"><input type="password" /></div><div class="fix"></div></div>
                    <div class="rowElem"><label class="topLabel">Autogrowing textarea:</label><div class="formBottom"><textarea rows="8" cols="" class="auto" name="textarea"></textarea></div><div class="fix"></div></div>
                    <input type="submit" value="Submit form" class="greyishBtn submitForm" />
                    <div class="fix"></div>
                </div>
            </fieldset>      
            
            <!-- And one more version -->
            <fieldset>
                <div class="widget">
                    <div class="head"><h5 class="iList">Form. One more version</h5></div>
                    <div class="floatleft twoOne">
                    <div class="rowElem noborder pb0"><label class="topLabel">Usual input text:</label><div class="formBottom"><input type="text" name="inputtext"/></div><div class="fix"></div></div>
                    <div class="rowElem noborder pb0"><label class="topLabel">Input password:</label><div class="formBottom"><input type="password" /></div><div class="fix"></div></div>
                    </div>
                    <div class="floatright twoOne">
                    <div class="rowElem noborder"><label class="topLabel">Textarea:</label><div class="formBottom"><textarea rows="7" cols="" name="textarea"></textarea></div><div class="fix"></div></div>
                    <input type="submit" value="Submit form" class="greyishBtn submitForm" />
                    
                    </div>
                    <div class="fix"></div>
                </div>
            </fieldset> 
        </form>       
