<table><tr><td> <em>Assignment: </em> IT202 Milestone 3 API Project</td></tr>
<tr><td> <em>Student: </em> Rishik Danda (rrd42)</td></tr>
<tr><td> <em>Generated: </em> 12/13/2023 6:19:26 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-3-api-project/grade/rrd42" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone3 branch</li><li>Create a new markdown file called milestone3.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone3.md</li><li>Add/commit/push the changes to Milestone3</li><li>PR Milestone3 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes just to be up to date</li><li>Submit the direct link to this new milestone3.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> API Data Association </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Consider how your API data will be associated with a user</td></tr>
<tr><td> <em>Response:</em> <p>There are three forms of association, all put into two tables. A user<br>can associate with a media by saying they have watched the media, favorite<br>the media, or give the media a rating from 1 to 5.&nbsp;<div><br><div>The watched<br>and favorite media will be an integer that can either be 0 or<br>1. 0 means they have not watched and/or favorite the media. 1 means<br>that they have watched the media/they favorited the media.&nbsp;</div><div><br></div><div>The ratings show how much<br>a user likes a media. It can be rated from 1-5. A rating<br>of 0 means the user has not rated the media.</div></div><div><br></div><div>The watched, favorite, and<br>ratings are all put in the Media_Classification (MC) table, and the ids from<br>the MC table are connected to the ids of the Users tables in<br>the User_Media_Association table.</div><div><br></div><div>Since a user can have multiple MCs for different media, the<br>MC ids were placed in a new table instead of the User table.</div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Handling Data Changes</td></tr>
<tr><td> <em>Response:</em> <p>Since the media details and the media associations are kept in separate tables,<br>updating the entity will not affect the association to the entity. Therefore, the<br>Media_details table will be updated, but the foreign key to the User table<br>will be unchanged for both the Media Details and the Media Classification tables.<br>Because of this, the user will see the new version of the media<br>but also see the original associations they made with the media.&nbsp;<div><br></div><div>For example, if<br>I favorited the movie Batman 1989, and the movie was edited to Batman<br>2022, I would have Batman 2022 on my favorite list.</div><br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Handle the association of data to a user </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Which option did you need to do to handle the association of data?</td></tr>
<tr><td> <em>Response:</em> <p>I updated my pages so the user can associate media with their account.&nbsp;<div><br></div><div>For<br>example, the list_media page shows all the media in the database, and each<br>media has a watched, favorite, and rating button to create associations with the<br>user.</div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add screenshots of the updated/created pages related to associating data with the user (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T21.53.22Screenshot%202023-12-13%20at%204.52.48%E2%80%AFPM.png.webp?alt=media&token=20f75fa3-068d-470f-a700-01a7699f082c"/></td></tr>
<tr><td> <em>Caption:</em> <p>The buttons will create rows for Media Classification and User Media Associations and<br>will update when clicked again. The user can also select the stars to<br>choose the ratings for the media.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T21.56.09Screenshot%202023-12-13%20at%204.56.01%E2%80%AFPM.png.webp?alt=media&token=2642c75a-f6a7-49d2-941e-db2a03944f62"/></td></tr>
<tr><td> <em>Caption:</em> <p>The user can also access the buttons from the list media page. However,<br>you cannot edit your ratings from here, but you can see the average<br>number of stars for a media.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.00.33Screenshot%202023-12-13%20at%205.00.21%E2%80%AFPM.png.webp?alt=media&token=ed36cbd0-1247-4ae9-8d05-67e2a77f2f33"/></td></tr>
<tr><td> <em>Caption:</em> <p>The buttons will trigger the SQL statements to change the associations in the<br>table and the page will read the new data to determine what color<br>or how many stars each media should have<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.03.09Screenshot%202023-12-13%20at%205.03.04%E2%80%AFPM.png.webp?alt=media&token=0e5cd108-a67c-47f7-a350-81411aa6171e"/></td></tr>
<tr><td> <em>Caption:</em> <p>This function contains the update or insert function to add of edit associations<br>to a media. There are additional similar functions for favorite, watched and ratings.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Include any Heroku prod links to pages that would trigger entity to user association</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/list_media.php?search=&limit=10&sort=title&order=ASC">https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/list_media.php?search=&limit=10&sort=title&order=ASC</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/single_media_view.php?id=63&search=&limit=10&sort=title&order=ASC&page=1">https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/single_media_view.php?id=63&search=&limit=10&sort=title&order=ASC&page=1</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/93">https://github.com/Danda1R/rrd42-IT202-007/pull/93</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Logged in user’s associated entities page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What is the data that's associated with the user?</td></tr>
<tr><td> <em>Response:</em> <p>The &quot;entities&quot; in my project are media. This can be a movie, tv<br>show, tv episode, podcast, video game, etc. Anything that can be experienced in<br>the visual or auditory medium.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show screenshots of the logged in user's entities associated with them  (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.09.44Screenshot%202023-12-13%20at%205.09.39%E2%80%AFPM.png.webp?alt=media&token=2e53beb2-d369-4353-bd69-c7c446f7b365"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the my associations page. It shows all the associations made to<br>the current user based on their user id. It includes the view and<br>delete buttons, the search bar, the total counts of media associated with this<br>user, the button to remove all associations to this user<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.26.42Screenshot%202023-12-13%20at%205.26.38%E2%80%AFPM.png.webp?alt=media&token=bda0d9f9-ef36-4a22-82b1-66693465e7a0"/></td></tr>
<tr><td> <em>Caption:</em> <p>I used the word avengers to search through the associations, changed the limit<br>to 1 and changed the order. The number of associations changed and the<br>limit, search and sorting works<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.28.06Screenshot%202023-12-13%20at%205.28.01%E2%80%AFPM.png.webp?alt=media&token=0cd0cddc-0091-48d3-b29f-ce514a623e95"/></td></tr>
<tr><td> <em>Caption:</em> <p>The code that organizes the database data into a table to display the<br>info, the view button and delete button.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.29.18Screenshot%202023-12-13%20at%205.29.15%E2%80%AFPM.png.webp?alt=media&token=a538423a-48d6-4e73-b8ec-d5b92717b45f"/></td></tr>
<tr><td> <em>Caption:</em> <p>This function contains  the SQL statements to get all the associations from<br>the table and how many associations there are.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) where the logged in user has their entities listed</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/list_associations.php?search=&limit=10&sort=title&order=ASC">https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/list_associations.php?search=&limit=10&sort=title&order=ASC</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/94">https://github.com/Danda1R/rrd42-IT202-007/pull/94</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> All Users association page (Note: This will likely be an admin page and is not the same as the previous item) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Describe/Explain the purpose of this page from your project perspective</td></tr>
<tr><td> <em>Response:</em> <p>This page is for admins to delete user associations if they are offensive<br>or inappropriate (one extra feature I wanted to add was reviews, so if<br>they were&nbsp;inappropriate, the admins could delete them)<div><br></div><div>It also allows the admins to access<br>specific users&#39;s profile, which has all of their associations.</div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show screenshots of the entity data associated with many users (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.35.21Screenshot%202023-12-13%20at%205.35.16%E2%80%AFPM.png.webp?alt=media&token=20457de0-948e-4ac7-9044-2ed9580431f1"/></td></tr>
<tr><td> <em>Caption:</em> <p>This view shows multiple associations between medias and many users. Each rows has<br>the username this item is associated with and the total number of users<br>the entity is associated with. The username is a link to the user&#39;s<br>profile and there is a view and delete button. Also, the heading shows<br>the number of association for the user and for all users.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.40.34Screenshot%202023-12-13%20at%205.39.57%E2%80%AFPM.png.webp?alt=media&token=cd1809a2-26d8-4be6-9e99-c928f75cd57a"/></td></tr>
<tr><td> <em>Caption:</em> <p>This shows using the search bar with the username filter. Using &quot;rish&quot; partial<br>filter, a limit of 4, and sorting by year, I get 4 rows<br>of association of only rishikdanda&#39;s associations. I also have the button to delete<br>all the associations for rishikdanda.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.43.08Screenshot%202023-12-13%20at%205.43.05%E2%80%AFPM.png.webp?alt=media&token=a7ebc31c-bd6e-463d-b4b2-836676eac705"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the SQL statement to get all the associations from all the<br>users. A similar SQL statement is used to get the count of associations.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) where entities associated to many users can be seen</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/admin/list_all_associations.php">https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/admin/list_all_associations.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/95">https://github.com/Danda1R/rrd42-IT202-007/pull/95</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Create a page that shows data not associated with any user (Note: This will likely be an admin page and is not the same as the previous item) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Show screenshots of the page showing entities not associated with anyone (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.44.49Screenshot%202023-12-13%20at%205.44.46%E2%80%AFPM.png.webp?alt=media&token=d52747d1-cf6d-42b9-97ce-10569e0e7d71"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the non association page, where all of these medias have not<br>been watched, favorited or rated by any user. Each rows has basic information,<br>a link to the detail view. The heading has the number of media<br>not associated with any users and the number of media on the page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.46.44Screenshot%202023-12-13%20at%205.46.40%E2%80%AFPM.png.webp?alt=media&token=8799f0ca-c8f9-43e3-b82a-bf1b55200c01"/></td></tr>
<tr><td> <em>Caption:</em> <p>The limit has been changed to 2, the filter has been set to<br>movies released in 2023, and the sorting has been year ascending. The heading<br>of the page reflects the filtering and limitings applied to the SQL statement.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.49.00Screenshot%202023-12-13%20at%205.48.57%E2%80%AFPM.png.webp?alt=media&token=71892c8b-07a0-43f6-8e12-04e06227ca9d"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the SQL statement used to get all the media that does<br>not have an association with any user<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add Heroku Prod links to the page(s) where unassociated entities can be seen</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/admin/list_all_non_associations.php">https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/admin/list_all_non_associations.php</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/96">https://github.com/Danda1R/rrd42-IT202-007/pull/96</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Admin can associate any entity with any users (Note: This may be a form on an existing association page if you rather not have a separate page for this) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing evidence of the checklist items (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.53.24Screenshot%202023-12-13%20at%205.53.21%E2%80%AFPM.png.webp?alt=media&token=d870d834-9725-46c2-8d5a-b275bd84d38f"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the admin association page. I used the partial filter &quot;rish&quot; for<br>the username and the partial filter &quot;Ave&quot; to filter the database. After I<br>click the apply button, the movie &quot;The Avengers&quot; and &quot;The Avengers Assemble Premiere&quot;<br>will be watched, favorited and receive a 5 star rating from rishikdanda (the<br>admin account is called sandwichman). <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.53.33Screenshot%202023-12-13%20at%205.53.28%E2%80%AFPM.png.webp?alt=media&token=30514bf9-2a40-424a-a74e-d94a44b121a5"/></td></tr>
<tr><td> <em>Caption:</em> <p>The association was successfully made<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.54.46Screenshot%202023-12-13%20at%205.54.09%E2%80%AFPM.png.webp?alt=media&token=d591dbfd-bf88-4b9e-8b59-24ac29a7a918"/></td></tr>
<tr><td> <em>Caption:</em> <p>The results of the admin associating.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.56.08Screenshot%202023-12-13%20at%205.56.06%E2%80%AFPM.png.webp?alt=media&token=4456d49f-342b-4a74-8ec7-f690bd515781"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the Post form that is filled with the data from the<br>database and sends a POST request to change the associations<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-13T22.57.18Screenshot%202023-12-13%20at%205.57.14%E2%80%AFPM.png.webp?alt=media&token=f4017cd7-232f-4330-bd96-fc92e704dcc2"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is where the POST request is received and it is processed and<br>the functions are called to update and add to the Association table.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explain the code logic for this page</td></tr>
<tr><td> <em>Response:</em> <p>SQL statements are used to get all the users and media in the<br>database. They input the partial filter as part of the WHERE clause using<br>a LIKE clause to match to usernames and media titles partially. The results<br>are converted into an array and inserted into a post form using a<br>for loop. Each user and media has a checkbox to select it for<br>the associations. When the apply button is clicked, the post request is sent<br>and looped through each pair of user and media. For each user and<br>media pair, the association specified are made by updating the association page or<br>inserting the association page if it already does not exist.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/admin/add_associations.php">https://it202-rrd42-prod-2f24ad61807f.herokuapp.com/Project/admin/add_associations.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/97">https://github.com/Danda1R/rrd42-IT202-007/pull/97</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> Reflection </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Document any issues/struggles</td></tr>
<tr><td> <em>Response:</em> <p>The most difficult part was creating the SQL statements. Learning how to join<br>even more tables together was difficult, but I also had to get the<br>number of media in the database based on filters and limits, how to<br>get the image url of a media based on the association ID, which<br>have no direct connection to each other. In addition, I had to create<br>a new SQL statement for each deliverable, so that is about 2 SQL<br>statements per deliverable, so over a dozen SQL statements that took 10-15 minutes<br>each.<div><br></div><div>I overcame this by writing out the connections between my tables, testing in<br>the MySQL extension before writing them in the website, and reading the internet<br>for examples and new clauses to add to my statements to save time.</div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Highlight any favorite topics</td></tr>
<tr><td> <em>Response:</em> <p>My favorite part was creating the association tables and editing my Milestone 2<br>pages to accommodate for associations. For example, I had to edit my list<br>media page and single media view page to have buttons that label a<br>media as being watched, starred and/or have a rating.&nbsp;<div><br></div><div>This was very exciting since<br>there were very little guidelines and I could code almost anything I wanted.<br>When I realized this, I recognized how my website was similar to movie<br>review website, which is inspiring me to continue to make this website into<br>a mini movie blog even after this semester ends.</div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Overall how do you feel you did with the project and meeting requirements</td></tr>
<tr><td> <em>Response:</em> <p>I feel very proud of my project. As a CS major, we usually<br>do not do major projects or coding until CS 490 and CS 491.<br>I feel that my project can be released as a working beta as<br>it is self-contained, properly connected to the database and the API and lack<br>any major bugs. I believe I matched all the deliverables put here, and<br>I even went above the deliverables by adding pagination, and updating the user&#39;s<br>profile and the home page with the most recent watched and favorited media.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Summarize your experience per the checklist items</td></tr>
<tr><td> <em>Response:</em> <p>I had a small-medium amount of development experience. I already took CS 490,<br>CS 491 and IT 266 before this class. However, those were mostly group<br>projects and I feel like I did not learn as much as I<br>should have. Now, I feel I have a medium-high amount of experience. I<br>also feel more confident in my experience and that I could work on<br>another project on my own or with a group, even if it was<br>in a different language or with new technology.<div><br></div><div>The only thing I would do<br>differently is to be more efficient with my functions. There are a lot<br>of functions for SQL statements that are extremely similar, but have small differences<br>in the query and parameters. In hindsight, I could have used parameters to<br>combine 3-4 functions into one without changing the purpose.</div><br></p><br></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-3-api-project/grade/rrd42" target="_blank">Grading</a></td></tr></table>
