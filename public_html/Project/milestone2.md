<table><tr><td> <em>Assignment: </em> IT202 Milestone 2 API Project</td></tr>
<tr><td> <em>Student: </em> Rishik Danda (rrd42)</td></tr>
<tr><td> <em>Generated: </em> 12/2/2023 10:09:51 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-2-api-project/grade/rrd42" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone2 branch</li><li>Create a new markdown file called milestone2.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone2.md</li><li>Add/commit/push the changes to Milestone2</li><li>PR Milestone2 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes to get ready for Milestone 3</li><li>Submit the direct link to this new milestone2.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Define the appropriate table or tables for your API </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of the table definition SQL files</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-28T23.30.20Screenshot%202023-11-28%20at%206.29.49%E2%80%AFPM.png.webp?alt=media&token=43d4a5ad-4c3f-48ed-9a22-b3412e8abbdf"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the Media_Genre table. It will store the names of all the<br>genres that a media can be classified as. This table will be auto-populated<br>by an API that returns a list of all possible genres.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-28T23.32.33Screenshot%202023-11-28%20at%206.32.05%E2%80%AFPM.png.webp?alt=media&token=0cda6797-7572-4876-9dfe-e43253da7ed9"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the Media_Type table. It will store the names of all the<br>types that media can be classified as (Movies, TV Episodes, Video Games). This<br>table will be auto-populated by an API that returns a list of all<br>possible media types.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-28T23.40.45Screenshot%202023-11-28%20at%206.40.16%E2%80%AFPM.png.webp?alt=media&token=5f59e6a9-fcbe-4c19-be73-1785f855700c"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the Media_List table. It will store the names of all the<br>list that media can be a part of (most_pop_series, top_rated_250, top_boxoffice_200). This table<br>will be auto-populated by an API that returns a list of all possible<br>media lists.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-28T23.42.31Screenshot%202023-11-28%20at%206.41.58%E2%80%AFPM.png.webp?alt=media&token=c9617b27-794f-4e74-9896-e1de5d543dd8"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the Media_Details table. It will store the names of all the<br>details of a specific media (Release Date, picture url, and the name)<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-11-28T23.44.27Screenshot%202023-11-28%20at%206.44.04%E2%80%AFPM.png.webp?alt=media&token=952d7214-5615-4687-b266-25f548fac232"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the Media table. This is where a media is mapped to<br>the Details, Genre, List and Type tables using foreign keys.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Mappings</td></tr>
<tr><td> <em>Response:</em> <p>Media_Genre:&nbsp;<div><ul><li><u>id</u> (Auto-Generated)</li><li><u>name</u> (Will be auto-populated by an API that returns a list of<br>all possible media genres)</li><li><u>created</u> (Auto-Generated)</li><li><u>modified</u> (Auto-Generated)</li></ul><div><br></div><div>Media_Type:&nbsp;</div><div><ul><li><u>id</u> (Auto-Generated)</li><li><u>name</u> (Will be auto-populated by an API<br>that returns a list of all possible media types)</li><li><u>created</u> (Auto-Generated)</li><li><u>modified</u> (Auto-Generated)</li></ul></div><div><br></div><div>Media_List:&nbsp;</div><div><ul><li><u>id</u> (Auto-Generated)</li><li><u>name</u> (Will<br>be auto-populated by an API that returns a list of all possible media<br>lists)</li><li><u>created</u> (Auto-Generated)</li><li><u>modified</u> (Auto-Generated)</li></ul></div><div><br></div><div><div>Media_Details:&nbsp;</div><div><ul><li><u>id</u> (Auto-Generated)</li><li><u>api_id</u> (The ID of each media from the API)</li><li><u>original_title</u> (The<br>name of the media from the API)</li><li><u>isSeries</u> (Whether the media is a series<br>or not from the API)</li><li><u>isEpisode</u> (Whether the media is an episode or not<br>from the API)</li><li><u>year</u> (What year the media came out from the API)</li><li><u>release_date</u> (The<br>release date of the media from the API)</li><li><u>api_image_id</u> (The ID of the image<br>for the media from the API)</li><li><u>image_url</u> (The public URL to the image of<br>the media from the API)</li><li><u>image_caption</u> (The caption for the image of the media<br>from the API)</li><li><u>created</u> (Auto-Generated)</li><li><u>modified</u> (Auto-Generated)</li></ul></div><div><div>Media:&nbsp;</div><div><ul><li><u>id</u>&nbsp;(Auto-Generated)</li><li><u>title</u>&nbsp;(The name of the media from the API)</li><li><u>details_id</u>&nbsp;(Foreign Key<br>to Media_Details id) Maps to Media_Details</li><li><u>type_id</u>&nbsp;(Foreign Key to Media_Type id) Maps to Media_Type</li><li><u>list_id</u>&nbsp;(Foreign<br>Key to Media_List id) Maps to Media_List</li><li><u>genre_id</u>&nbsp;(Foreign Key to Media_Genre id) Maps to<br>Media_Genre</li><li><u>created</u>&nbsp;(Auto-Generated)</li><li><u>modified</u>&nbsp;(Auto-Generated)</li></ul></div></div></div></div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/57">https://github.com/Danda1R/rrd42-IT202-007/pull/57</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Data Creation Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of the Page and the Code (at least two)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.10.27Screenshot%202023-12-02%20at%207.07.08%E2%80%AFPM.png.webp?alt=media&token=09cae271-2ab0-43ff-84a2-6ba5313b1a93"/></td></tr>
<tr><td> <em>Caption:</em> <p>Filled out the form field with valid data before submission<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.13.06Screenshot%202023-12-02%20at%207.06.57%E2%80%AFPM.png.webp?alt=media&token=37d94aba-8d33-4ca5-ba01-b040dfaef336"/></td></tr>
<tr><td> <em>Caption:</em> <p>Flash message that the media is successfully created<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.14.47Screenshot%202023-12-02%20at%207.08.42%E2%80%AFPM.png.webp?alt=media&token=cabd02a9-73e4-43f2-aa3e-1d0960a0b48a"/></td></tr>
<tr><td> <em>Caption:</em> <p>A flash message showing the error if the release date is the incorrect<br>format<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.21.23Screenshot%202023-12-02%20at%207.09.07%E2%80%AFPM.png.webp?alt=media&token=718613d1-03af-4aab-860d-beeaa2d0d2ea"/></td></tr>
<tr><td> <em>Caption:</em> <p>Code of add_media.php #1 showing the validation of the data with the correct<br>data validation for the POST form using flash messages to verify the data<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.24.24Screenshot%202023-12-02%20at%207.09.25%E2%80%AFPM.png.webp?alt=media&token=0b2e66be-bd32-49d6-9967-84b0db90b0b6"/></td></tr>
<tr><td> <em>Caption:</em> <p>Code of add_media.php #2 showing the code of the POST form with the<br>correct data types being requested<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Database Results</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.38.02Screenshot%202023-12-02%20at%207.35.00%E2%80%AFPM.png.webp?alt=media&token=3b2055bb-4dbf-4d26-8387-7d6641dfcb19"/></td></tr>
<tr><td> <em>Caption:</em> <p>Media_Details table, which has whether the media is manually created or API created.<br>If the media&#39;s api_id is null, then it is manually created. If it<br>is filled, then it is created by the API.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Misc Checklist</td></tr>
<tr><td> <em>Response:</em> <p>The combination of the name and the release year makes the entities unique.<br>If you try to add a media with the same name and release<br>year as an existing media, then the insertion will fail and will not<br>be added. For API-added media, the api_id is a unique key in the<br>SQL creation. Therefore, if more than one of the same media from the<br>API is added, it will fail and not be added. Only Admins can<br>create entities.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-3cbbb1b8bda5.herokuapp.com/Project/admin/add_media.php">https://it202-rrd42-prod-3cbbb1b8bda5.herokuapp.com/Project/admin/add_media.php</a> </td></tr>
<tr><td> <em>Sub-Task 5: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/58">https://github.com/Danda1R/rrd42-IT202-007/pull/58</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Data List Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot the list page and code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.50.08Screenshot%202023-12-02%20at%207.48.02%E2%80%AFPM.png.webp?alt=media&token=1824e213-f9af-4184-a5c9-b82cb2609925"/></td></tr>
<tr><td> <em>Caption:</em> <p>Data List Page sorted by title descending with no search filter and standard<br>limit of 10<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.52.10Screenshot%202023-12-02%20at%207.48.43%E2%80%AFPM.png.webp?alt=media&token=a3264333-55e7-42c2-b13e-5d2c84d02334"/></td></tr>
<tr><td> <em>Caption:</em> <p>Data List Page sorted by title ascending with a search filter of the<br>word &quot;of&quot; and a standard limit of 10<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.52.54Screenshot%202023-12-02%20at%207.49.49%E2%80%AFPM.png.webp?alt=media&token=0d255e6b-7a20-4ad8-8e1a-c73d3992cc0d"/></td></tr>
<tr><td> <em>Caption:</em> <p>Data List Page when the filter did not have any matching records. In<br>this case, the flash message was sent and the user was returned to<br>the standard data list page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.55.13Screenshot%202023-12-02%20at%207.55.10%E2%80%AFPM.png.webp?alt=media&token=07113af6-3406-4e99-9e86-7f3378e127a3"/></td></tr>
<tr><td> <em>Caption:</em> <p>Data List Page with no search filter and ascending sort by year with<br>a limit of 4<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T00.57.42Screenshot%202023-12-02%20at%207.56.18%E2%80%AFPM.png.webp?alt=media&token=54a4b61d-aefe-4bdb-9644-fce2305b981f"/></td></tr>
<tr><td> <em>Caption:</em> <p>Code of list_media.php showing how the form has a min and max to<br>keep the limit of records between 1 and 100<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>Logged-in users can view this page and view the individual pages of each<br>entity. However, only admins can access the edit and delete pages of each<br>entity.<div><br></div><div>The server goes through the Media table and gets the ID, name, release<br>year, genre, image link, and API_ID of each media based on the limit.<br>The page then loops through each media, creating a card with all of<br>the information. For example, if the API_id is null (meaning it is manually<br>created), then the page will write that in place of the API ID.<br>There are also links for each card that uses the ID to take<br>the user to each view, delete, and edit page.</div><div><br></div><div>The filter/searching form will create<br>a get request that is used to append to the SQL Select statement.<br>This includes using the WHERE clause of searching, ORDER BY for ascending or<br>descending and by title/year/genre, and the&nbsp;LIMIT clause for the number of return data.</div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-3cbbb1b8bda5.herokuapp.com/Project/list_media.php?search=&limit=10&sort=title&order=ASC">https://it202-rrd42-prod-3cbbb1b8bda5.herokuapp.com/Project/list_media.php?search=&limit=10&sort=title&order=ASC</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/59">https://github.com/Danda1R/rrd42-IT202-007/pull/59</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> View Details Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of Page and related content/code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T01.08.42Screenshot%202023-12-02%20at%208.08.19%E2%80%AFPM.png.webp?alt=media&token=04f8ef14-5838-4c00-be08-13072f7cd6e5"/></td></tr>
<tr><td> <em>Caption:</em> <p>The page single_media_view.php that uses the id passed through query parameters in the<br>URL of GOTG 3<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T01.10.18Screenshot%202023-12-02%20at%208.08.30%E2%80%AFPM.png.webp?alt=media&token=6dd4fe98-4f33-4258-a3e7-1d9ce7b962d5"/></td></tr>
<tr><td> <em>Caption:</em> <p>If the ID is changed to an invalid id, the user is warned<br>and taken back to the list_media.php<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T01.12.36Screenshot%202023-12-02%20at%208.11.14%E2%80%AFPM.png.webp?alt=media&token=f5c1c1f5-d45f-42cd-bf7e-1b78088a5755"/></td></tr>
<tr><td> <em>Caption:</em> <p>Code of single_media_view.php showing the links to the edit and delete page and<br>how the full details of the media is displayed<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>The release date, the list it belongs to, the image caption and whether<br>it is an episode and/or a series is included are the extra details<br>shown in this view.<div><br></div><div>Only admins are allowed to access the edit and delete<br>links on the page.</div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-3cbbb1b8bda5.herokuapp.com/Project/single_media_view.php?id=20&search=&limit=10&sort=media_title&order=ASC">https://it202-rrd42-prod-3cbbb1b8bda5.herokuapp.com/Project/single_media_view.php?id=20&search=&limit=10&sort=media_title&order=ASC</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/61">https://github.com/Danda1R/rrd42-IT202-007/pull/61</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Edit Data Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of Page and related content/code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T01.47.38Screenshot%202023-12-02%20at%208.41.26%E2%80%AFPM.png.webp?alt=media&token=00de3831-eeb2-48a9-9c50-91f408cac7bc"/></td></tr>
<tr><td> <em>Caption:</em> <p>The edit_media.php page, where the id is passed through query parameters in the<br>URL, and the form is pre-filled with the media details (GOTG 3)<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.05.56Screenshot%202023-12-02%20at%208.50.17%E2%80%AFPM.png.webp?alt=media&token=dc02b706-c4cd-4456-b418-924dcf29486f"/></td></tr>
<tr><td> <em>Caption:</em> <p>An invalid id takes the user back to the list_media.php page and sends<br>a flash message<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.07.46Screenshot%202023-12-02%20at%209.07.42%E2%80%AFPM.png.webp?alt=media&token=2d2dd19d-1c70-48f7-a8c4-a93a8c9537a2"/></td></tr>
<tr><td> <em>Caption:</em> <p>After submitting changes, and new changes has been autofilled in the form and<br>the flash messages confirm the edit<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.13.49Screenshot%202023-12-02%20at%209.13.22%E2%80%AFPM.png.webp?alt=media&token=a9deafbd-8185-4cc2-8b15-897a918a1232"/></td></tr>
<tr><td> <em>Caption:</em> <p>Edit_media.php #1 Server side verification showing the correct validation for each form field<br>and friendly error messages for the users<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.16.05Screenshot%202023-12-02%20at%209.13.40%E2%80%AFPM.png.webp?alt=media&token=b1a035db-3fbb-480f-8f51-a054e0d5b92b"/></td></tr>
<tr><td> <em>Caption:</em> <p>Edit_media.php #2 The POST request that has all the proper data types for<br>each properties being requested<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202-rrd42-prod-3cbbb1b8bda5.herokuapp.com/Project/admin/edit_media.php?id=20&search=&limit=10&sort=title&order=ASC">https://it202-rrd42-prod-3cbbb1b8bda5.herokuapp.com/Project/admin/edit_media.php?id=20&search=&limit=10&sort=title&order=ASC</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/62">https://github.com/Danda1R/rrd42-IT202-007/pull/62</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Delete Handling </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of related code/evidence</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.20.22Screenshot%202023-12-02%20at%209.18.32%E2%80%AFPM.png.webp?alt=media&token=55029ac8-1d68-497b-b72d-d5920ff9b4d2"/></td></tr>
<tr><td> <em>Caption:</em> <p>A non-Admin trying to access the delete_media.php page<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.21.01Screenshot%202023-12-02%20at%209.18.51%E2%80%AFPM.png.webp?alt=media&token=38dfc360-9255-40cb-b1f9-2a0135f26894"/></td></tr>
<tr><td> <em>Caption:</em> <p>Trying to access the delete_media.php with an invalid ID<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.22.13Screenshot%202023-12-02%20at%209.19.56%E2%80%AFPM.png.webp?alt=media&token=aa4f6648-aeef-4080-8336-4b28fb3e5447"/></td></tr>
<tr><td> <em>Caption:</em> <p>The list_media.php with a limit and genre descending sort before deletion<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.22.30Screenshot%202023-12-02%20at%209.20.01%E2%80%AFPM.png.webp?alt=media&token=e7393452-c70a-4c89-85ca-e23ea0bb70ba"/></td></tr>
<tr><td> <em>Caption:</em> <p>The list_media.php with the same limit and genre descending sort after deletion<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.23.20Screenshot%202023-12-02%20at%209.23.10%E2%80%AFPM.png.webp?alt=media&token=cbb6088f-d561-4808-bb55-f013d23a22aa"/></td></tr>
<tr><td> <em>Caption:</em> <p>The delete_media.php page that uses a select statement to get the correct ID<br>and two delete statements to delete from the Media and the Media_details tables<br><br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>Only admins can delete items. They can also delete data created by other<br>admins<div><br><div>The deletion starts with a delete statement that deletes from the Media table<br>since it has a foreign key to the Media_Details table.</div><div>Then, the Media_details table<br>is deleted from</div><div><br></div></div><div>The sort and filter parameters from the list_media.php are included in<br>the get request to the delete_media.php, so when the user deletes the data<br>and is returned to the list_media.php, the sort and filter parameters are still<br>in the URL and can be applied to the list_media.php page.</div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/63\">https://github.com/Danda1R/rrd42-IT202-007/pull/63\</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> API Handling </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of Code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.47.40Screenshot%202023-12-02%20at%209.38.58%E2%80%AFPM.png.webp?alt=media&token=00b9a55c-d997-4190-b3f7-de06cc9edd25"/></td></tr>
<tr><td> <em>Caption:</em> <p>add_api_media.php where the get request is used to get an array of media<br>using the title and year of the media<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.50.01Screenshot%202023-12-02%20at%209.39.05%E2%80%AFPM.png.webp?alt=media&token=1e5a060a-796f-40c7-9d5b-a5ad4c5b1af1"/></td></tr>
<tr><td> <em>Caption:</em> <p>add_api_media.php where the get request is used to get an array of media<br>using the genre, list and type of the media<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.50.50Screenshot%202023-12-02%20at%209.39.11%E2%80%AFPM.png.webp?alt=media&token=f2f77235-0a57-4216-87d4-fa0e0ed1bc16"/></td></tr>
<tr><td> <em>Caption:</em> <p>add_genre_list_type.php to fill out the genre, list and type tables automatically using the<br>API<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.51.50Screenshot%202023-12-02%20at%209.39.26%E2%80%AFPM.png.webp?alt=media&token=8c845d99-4dd9-4dbc-9faa-7857d22132d3"/></td></tr>
<tr><td> <em>Caption:</em> <p>add_api_media.php using the get request of the type, genre and list and mapping<br>it to the Media_details and Media table<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.51.56Screenshot%202023-12-02%20at%209.39.31%E2%80%AFPM.png.webp?alt=media&token=69561303-57d8-4539-bdcb-4c7fe7b018fe"/></td></tr>
<tr><td> <em>Caption:</em> <p>add_api_media.php using the get request of the name and year and mapping it<br>to the Media_details and Media table<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T02.52.52Screenshot%202023-12-02%20at%209.40.06%E2%80%AFPM.png.webp?alt=media&token=0c912f4d-c319-4d3b-b53a-f5648060fd2c"/></td></tr>
<tr><td> <em>Caption:</em> <p>Creating the Media_details table. Since the api_id is unique, any already existing media<br>cannot be added again.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>The results of the API are decoded and reorganized into a new array<br>so the details are formatted correctly for the table. Then, the data is<br>added to the Media_Details and the Media table with the correct validation and<br>formats.<div><br></div><div>The API is called manually using the&nbsp;add_genre_list_type.php to update the Genre, Type, and<br>List table, and the add_api_media.php page to add to the Media_Details and Media<br>table manually, using forms to search for specific names, genres, and years.</div><div><br></div><div>My API<br>is media details (movies, TV shows, podcasts, video games), but my application is<br>to create a review website where people can review current media, post their<br>media, and rate and produce constructive criticism on other media.</div><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/Danda1R/rrd42-IT202-007/pull/64">https://github.com/Danda1R/rrd42-IT202-007/pull/64</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> Misc </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What issues did you face and overcome during this milestone?</td></tr>
<tr><td> <em>Response:</em> <p>The biggest issue was running SQL statements from the server side since I<br>tried to automate the statements instead of writing them out every time. This<br>became extremely complicated since I had to echo and push to the error<br>log to see what was causing the problems. I would make very small<br>errors that would take 5-10 minutes to fix each one, which added up<br>by the end<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> What did you find the easiest?</td></tr>
<tr><td> <em>Response:</em> <p>Creating a single view of a specific media was very easy since I<br>was very confident in my GET request and the page itself was a<br>more detailed version of the list view page.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> What did you find the hardest?</td></tr>
<tr><td> <em>Response:</em> <p>Again, the hardest part was using the SQL statements. Since SQL statements were<br>used on every page, I had to write, test, rewrite, and fix my<br>SQL statements over and over again until I understood how to fix them.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Did you have to utilize any unanticipated APIs?</td></tr>
<tr><td> <em>Response:</em> <p>Originally, I was going to use a Dad Joke API. However, the professor&#39;s<br>lessons helped me realize that I needed more details and information from my<br>API to create multiple tables and details from the API, not from the<br>users. Although I wished I realized this sooner, I eventually found the Movie<br>API and was successful in its utilization.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a screenshot of your project board</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Frrd42%2F2023-12-03T03.08.01Screenshot%202023-12-02%20at%2010.07.27%E2%80%AFPM.png.webp?alt=media&token=d98bbb42-43ec-48ff-beaa-1c43e67be544"/></td></tr>
<tr><td> <em>Caption:</em> <p>My project board of Milestone 2<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-2-api-project/grade/rrd42" target="_blank">Grading</a></td></tr></table>
