aspiringminds
=============
How to use the project?
>>
1.Copy the directory "aspiringminds" of this repo to "/var/www/" directory in linux or in xampp/htdocs/ folder in windows OS.
2.Write the problem in problems.txt file.
3.Open a web browser and go to "localhost/aspiringminds/inputs.html".
4.Now in this page, you can type the code directly in the textarea or you can do this:
provide the details to fill the input form, submit the details, select the appropriate suggestion and add it to the textarea.
5.If invalid data is provided, then in place of suggestion it gives appropriate error message.
6.After adding desired number of functions or class, and completing its code, you can submit your code to be tested by external php file (not included here).

Flow of controls and data:
>>
Question contained in problem.txt is displayed using problem.php in frame inside div class="problem".
content provider provides input for defining function and/or class for language java and C using dynamic form created using javascript.
When content provider clicks on submit, the input values are sent to backend.php page using ajax to validate the input 
and to provide suggestions based on the input values. The suggestions or the error message are displayed inside div class="create". 
The content provider can select any of the suggestions according to his need and press the button with label "Add suggestion to coding area".
After clicking this button the suggested function/class or even the commented error message if any, is appended to the textarea provided below.
The content provider can also edit the code in textarea by himself as per the requirement.
Finally after clicking the submit code, the contents are send to external php file check_sol.php to test the source code.

Comments are provided in the source files to understand the code easily.
