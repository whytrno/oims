<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/2.0.3/js/dataTables.tailwindcss.js"></script> --}}
    {{-- @vite('resources/js/datatable.js') --}}
    @vite('resources/js/dataTables.js')
    @vite('resources/js/dataTables.tailwindcss.js')
    @vite('resources/css/datatable.css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.tailwindcss.css"> --}}
</head>

<body class="min-h-screen bg-background font-sans antialiased">
    <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
        {{-- SIDEBAR --}}
        <div class="hidden border-r bg-muted/40 md:block">
            <div class="flex h-full max-h-screen flex-col gap-4">
                <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
                    <a href="/" class="flex items-center gap-2 font-semibold">
                        <img src="/logo.png" alt="logo" class="size-10" />
                        <span class="">OimsApps</span>
                    </a>
                </div>
                <div class="flex-1">
                    <nav class="grid gap-2 items-start px-2 text-sm font-medium lg:px-4">
                        <a href={item.path}
                            class="flex items-center gap-3 rounded-lg px-5 py-3 transition-all text-muted-foreground hover:text-primary">
                            <iconify-icon icon="mdi:home" observer="false"></iconify-icon>
                            Dashboard
                        </a>

                        <a href={item.path}
                            class="flex items-center gap-3 rounded-lg px-5 py-3 transition-all bg-primary text-white">
                            <iconify-icon icon="mdi:home" observer="false"></iconify-icon>
                            Dashboard2
                        </a>
                    </nav>

                </div>
            </div>
        </div>
        <div class="flex flex-col">
            {{-- NAVBAR --}}
            <header class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6">
                {{-- USER MOBILE --}}
                <button onclick="toggleMobileSidebar()"
                    class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 w-9 shrink-0 md:hidden"
                    type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-:R2quda:"
                    data-state="closed">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-menu h-5 w-5">
                        <line x1="4" x2="20" y1="12" y2="12"></line>
                        <line x1="4" x2="20" y1="6" y2="6"></line>
                        <line x1="4" x2="20" y1="18" y2="18"></line>
                    </svg>
                    <span class="sr-only">Toggle navigation menu</span>
                </button>

                <div class="w-full flex-1"></div>

                {{-- USER NAV INFO --}}
                <div class="flex gap-2 items-center" type="button" id="radix-:R6quda:" aria-haspopup="menu"
                    aria-expanded="false" data-state="closed">
                    <div class="flex flex-col gap-1 items-end capitalize">
                        <p>Management</p>
                        <p class="text-xs">management</p>
                    </div>
                    <button onclick="toggleUserNavModal()"
                        class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-secondary text-secondary-foreground shadow-sm hover:bg-secondary/80 h-9 w-9 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-user h-5 w-5">
                            <circle cx="12" cy="12" r="10">

                            </circle>
                            <circle cx="12" cy="10" r="3">

                            </circle>
                            <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662">

                            </path>
                        </svg>
                        <span class="sr-only">Toggle user menu</span>
                    </button>
                </div>
            </header>
            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6 w-screen lg:w-full">
                {{-- MAIN --}}
                <div class="flex justify-between items-center">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-lg font-semibold md:text-2xl">Karyawan</h1>
                        <nav aria-label="breadcrumb" class="flex">
                            <ol
                                class="flex flex-wrap items-center gap-1.5 break-words text-sm text-muted-foreground sm:gap-2.5">
                                <li class="inline-flex items-center gap-1.5"><a
                                        class="transition-colors hover:text-foreground"
                                        href="https://oims-apps.my.id"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-home size-4">
                                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a>
                                </li>
                                <li role="presentation" aria-hidden="true" class="[&amp;>svg]:size-3.5"><svg
                                        width="15" height="15" viewBox="0 0 15 15" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.1584 3.13508C6.35985 2.94621 6.67627 2.95642 6.86514 3.15788L10.6151 7.15788C10.7954 7.3502 10.7954 7.64949 10.6151 7.84182L6.86514 11.8418C6.67627 12.0433 6.35985 12.0535 6.1584 11.8646C5.95694 11.6757 5.94673 11.3593 6.1356 11.1579L9.565 7.49985L6.1356 3.84182C5.94673 3.64036 5.95694 3.32394 6.1584 3.13508Z"
                                            fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                                    </svg>
                                </li>
                                <li class="inline-flex items-center gap-1.5">
                                    <a class="transition-colors hover:text-foreground"
                                        href="https://oims-apps.my.id/karyawan">Karyawan
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div><button
                        class="inline-flex items-center justify-center whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 rounded-md px-3 text-xs h-7 gap-1"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-plus h-3.5 w-3.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 12h8"></path>
                            <path d="M12 8v8"></path>
                        </svg>
                        <span class="sr-only sm:not-sr-only sm:whitespace-nowrap">Add Data</span>
                    </button>
                </div>

                <table id="example" class="overflow-auto">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011-04-25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011-07-25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009-01-12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012-03-29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008-11-28</td>
                            <td>$162,700</td>
                        </tr>
                        <tr>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012-12-02</td>
                            <td>$372,000</td>
                        </tr>
                        <tr>
                            <td>Herrod Chandler</td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                            <td>59</td>
                            <td>2012-08-06</td>
                            <td>$137,500</td>
                        </tr>
                        <tr>
                            <td>Rhona Davidson</td>
                            <td>Integration Specialist</td>
                            <td>Tokyo</td>
                            <td>55</td>
                            <td>2010-10-14</td>
                            <td>$327,900</td>
                        </tr>
                        <tr>
                            <td>Colleen Hurst</td>
                            <td>Javascript Developer</td>
                            <td>San Francisco</td>
                            <td>39</td>
                            <td>2009-09-15</td>
                            <td>$205,500</td>
                        </tr>
                        <tr>
                            <td>Sonya Frost</td>
                            <td>Software Engineer</td>
                            <td>Edinburgh</td>
                            <td>23</td>
                            <td>2008-12-13</td>
                            <td>$103,600</td>
                        </tr>
                        <tr>
                            <td>Jena Gaines</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>30</td>
                            <td>2008-12-19</td>
                            <td>$90,560</td>
                        </tr>
                        <tr>
                            <td>Quinn Flynn</td>
                            <td>Support Lead</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2013-03-03</td>
                            <td>$342,000</td>
                        </tr>
                        <tr>
                            <td>Charde Marshall</td>
                            <td>Regional Director</td>
                            <td>San Francisco</td>
                            <td>36</td>
                            <td>2008-10-16</td>
                            <td>$470,600</td>
                        </tr>
                        <tr>
                            <td>Haley Kennedy</td>
                            <td>Senior Marketing Designer</td>
                            <td>London</td>
                            <td>43</td>
                            <td>2012-12-18</td>
                            <td>$313,500</td>
                        </tr>
                        <tr>
                            <td>Tatyana Fitzpatrick</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>19</td>
                            <td>2010-03-17</td>
                            <td>$385,750</td>
                        </tr>
                        <tr>
                            <td>Michael Silva</td>
                            <td>Marketing Designer</td>
                            <td>London</td>
                            <td>66</td>
                            <td>2012-11-27</td>
                            <td>$198,500</td>
                        </tr>
                        <tr>
                            <td>Paul Byrd</td>
                            <td>Chief Financial Officer (CFO)</td>
                            <td>New York</td>
                            <td>64</td>
                            <td>2010-06-09</td>
                            <td>$725,000</td>
                        </tr>
                        <tr>
                            <td>Gloria Little</td>
                            <td>Systems Administrator</td>
                            <td>New York</td>
                            <td>59</td>
                            <td>2009-04-10</td>
                            <td>$237,500</td>
                        </tr>
                        <tr>
                            <td>Bradley Greer</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>41</td>
                            <td>2012-10-13</td>
                            <td>$132,000</td>
                        </tr>
                        <tr>
                            <td>Dai Rios</td>
                            <td>Personnel Lead</td>
                            <td>Edinburgh</td>
                            <td>35</td>
                            <td>2012-09-26</td>
                            <td>$217,500</td>
                        </tr>
                        <tr>
                            <td>Jenette Caldwell</td>
                            <td>Development Lead</td>
                            <td>New York</td>
                            <td>30</td>
                            <td>2011-09-03</td>
                            <td>$345,000</td>
                        </tr>
                        <tr>
                            <td>Yuri Berry</td>
                            <td>Chief Marketing Officer (CMO)</td>
                            <td>New York</td>
                            <td>40</td>
                            <td>2009-06-25</td>
                            <td>$675,000</td>
                        </tr>
                        <tr>
                            <td>Caesar Vance</td>
                            <td>Pre-Sales Support</td>
                            <td>New York</td>
                            <td>21</td>
                            <td>2011-12-12</td>
                            <td>$106,450</td>
                        </tr>
                        <tr>
                            <td>Doris Wilder</td>
                            <td>Sales Assistant</td>
                            <td>Sydney</td>
                            <td>23</td>
                            <td>2010-09-20</td>
                            <td>$85,600</td>
                        </tr>
                        <tr>
                            <td>Angelica Ramos</td>
                            <td>Chief Executive Officer (CEO)</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2009-10-09</td>
                            <td>$1,200,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Joyce</td>
                            <td>Developer</td>
                            <td>Edinburgh</td>
                            <td>42</td>
                            <td>2010-12-22</td>
                            <td>$92,575</td>
                        </tr>
                        <tr>
                            <td>Jennifer Chang</td>
                            <td>Regional Director</td>
                            <td>Singapore</td>
                            <td>28</td>
                            <td>2010-11-14</td>
                            <td>$357,650</td>
                        </tr>
                        <tr>
                            <td>Brenden Wagner</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>28</td>
                            <td>2011-06-07</td>
                            <td>$206,850</td>
                        </tr>
                        <tr>
                            <td>Fiona Green</td>
                            <td>Chief Operating Officer (COO)</td>
                            <td>San Francisco</td>
                            <td>48</td>
                            <td>2010-03-11</td>
                            <td>$850,000</td>
                        </tr>
                        <tr>
                            <td>Shou Itou</td>
                            <td>Regional Marketing</td>
                            <td>Tokyo</td>
                            <td>20</td>
                            <td>2011-08-14</td>
                            <td>$163,000</td>
                        </tr>
                        <tr>
                            <td>Michelle House</td>
                            <td>Integration Specialist</td>
                            <td>Sydney</td>
                            <td>37</td>
                            <td>2011-06-02</td>
                            <td>$95,400</td>
                        </tr>
                        <tr>
                            <td>Suki Burks</td>
                            <td>Developer</td>
                            <td>London</td>
                            <td>53</td>
                            <td>2009-10-22</td>
                            <td>$114,500</td>
                        </tr>
                        <tr>
                            <td>Prescott Bartlett</td>
                            <td>Technical Author</td>
                            <td>London</td>
                            <td>27</td>
                            <td>2011-05-07</td>
                            <td>$145,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Cortez</td>
                            <td>Team Leader</td>
                            <td>San Francisco</td>
                            <td>22</td>
                            <td>2008-10-26</td>
                            <td>$235,500</td>
                        </tr>
                        <tr>
                            <td>Martena Mccray</td>
                            <td>Post-Sales support</td>
                            <td>Edinburgh</td>
                            <td>46</td>
                            <td>2011-03-09</td>
                            <td>$324,050</td>
                        </tr>
                        <tr>
                            <td>Unity Butler</td>
                            <td>Marketing Designer</td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2009-12-09</td>
                            <td>$85,675</td>
                        </tr>
                        <tr>
                            <td>Howard Hatfield</td>
                            <td>Office Manager</td>
                            <td>San Francisco</td>
                            <td>51</td>
                            <td>2008-12-16</td>
                            <td>$164,500</td>
                        </tr>
                        <tr>
                            <td>Hope Fuentes</td>
                            <td>Secretary</td>
                            <td>San Francisco</td>
                            <td>41</td>
                            <td>2010-02-12</td>
                            <td>$109,850</td>
                        </tr>
                        <tr>
                            <td>Vivian Harrell</td>
                            <td>Financial Controller</td>
                            <td>San Francisco</td>
                            <td>62</td>
                            <td>2009-02-14</td>
                            <td>$452,500</td>
                        </tr>
                        <tr>
                            <td>Timothy Mooney</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>37</td>
                            <td>2008-12-11</td>
                            <td>$136,200</td>
                        </tr>
                        <tr>
                            <td>Jackson Bradshaw</td>
                            <td>Director</td>
                            <td>New York</td>
                            <td>65</td>
                            <td>2008-09-26</td>
                            <td>$645,750</td>
                        </tr>
                        <tr>
                            <td>Olivia Liang</td>
                            <td>Support Engineer</td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2011-02-03</td>
                            <td>$234,500</td>
                        </tr>
                        <tr>
                            <td>Bruno Nash</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>38</td>
                            <td>2011-05-03</td>
                            <td>$163,500</td>
                        </tr>
                        <tr>
                            <td>Sakura Yamamoto</td>
                            <td>Support Engineer</td>
                            <td>Tokyo</td>
                            <td>37</td>
                            <td>2009-08-19</td>
                            <td>$139,575</td>
                        </tr>
                        <tr>
                            <td>Thor Walton</td>
                            <td>Developer</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2013-08-11</td>
                            <td>$98,540</td>
                        </tr>
                        <tr>
                            <td>Finn Camacho</td>
                            <td>Support Engineer</td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2009-07-07</td>
                            <td>$87,500</td>
                        </tr>
                        <tr>
                            <td>Serge Baldwin</td>
                            <td>Data Coordinator</td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2012-04-09</td>
                            <td>$138,575</td>
                        </tr>
                        <tr>
                            <td>Zenaida Frank</td>
                            <td>Software Engineer</td>
                            <td>New York</td>
                            <td>63</td>
                            <td>2010-01-04</td>
                            <td>$125,250</td>
                        </tr>
                        <tr>
                            <td>Zorita Serrano</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>56</td>
                            <td>2012-06-01</td>
                            <td>$115,000</td>
                        </tr>
                        <tr>
                            <td>Jennifer Acosta</td>
                            <td>Junior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>43</td>
                            <td>2013-02-01</td>
                            <td>$75,650</td>
                        </tr>
                        <tr>
                            <td>Cara Stevens</td>
                            <td>Sales Assistant</td>
                            <td>New York</td>
                            <td>46</td>
                            <td>2011-12-06</td>
                            <td>$145,600</td>
                        </tr>
                        <tr>
                            <td>Hermione Butler</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2011-03-21</td>
                            <td>$356,250</td>
                        </tr>
                        <tr>
                            <td>Lael Greer</td>
                            <td>Systems Administrator</td>
                            <td>London</td>
                            <td>21</td>
                            <td>2009-02-27</td>
                            <td>$103,500</td>
                        </tr>
                        <tr>
                            <td>Jonas Alexander</td>
                            <td>Developer</td>
                            <td>San Francisco</td>
                            <td>30</td>
                            <td>2010-07-14</td>
                            <td>$86,500</td>
                        </tr>
                        <tr>
                            <td>Shad Decker</td>
                            <td>Regional Director</td>
                            <td>Edinburgh</td>
                            <td>51</td>
                            <td>2008-11-13</td>
                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Michael Bruce</td>
                            <td>Javascript Developer</td>
                            <td>Singapore</td>
                            <td>29</td>
                            <td>2011-06-27</td>
                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Donna Snider</td>
                            <td>Customer Support</td>
                            <td>New York</td>
                            <td>27</td>
                            <td>2011-01-25</td>
                            <td>$112,000</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot>
                </table>
            </main>
        </div>
    </div>

    {{-- MOBILE SIDEBAR MODAL --}}
    <div id="sidebar-mobile-modal" role="dialog" id="radix-:R2quda:" aria-describedby="radix-:R2qudaH2:"
        aria-labelledby="radix-:R2qudaH1:" data-state="closed"
        class="fixed z-50 gap-4 bg-background p-6 shadow-lg transition ease-in-out data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:duration-300 data-[state=open]:duration-500 inset-y-0 left-0 h-full w-3/4 border-r data-[state=closed]:slide-out-to-left data-[state=open]:slide-in-from-left sm:max-w-sm data-[state=open]:flex data-[state=closed]:hidden flex-col bg-white"
        tabindex="-1" style="pointer-events: auto;">
        <nav class="grid gap-2 text-lg font-medium">
            <a class="flex items-center gap-2 text-lg font-semibold" href="#">
                <img alt="logo" loading="lazy" width="42" height="42" decoding="async" data-nimg="1"
                    srcset="/_next/image?url=%2Flogo.png&amp;w=48&amp;q=75 1x, /_next/image?url=%2Flogo.png&amp;w=96&amp;q=75 2x"
                    src="/_next/image?url=%2Flogo.png&amp;w=96&amp;q=75" style="color: transparent;">
                <span class="sr-only">OimsApps</span>
            </a>
            <a class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-home h-5 w-5">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z">

                    </path>
                    <polyline points="9 22 9 12 15 12 15 22">

                    </polyline>
                </svg>Dashboard</a>
            <a class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                href="/karyawan">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                    <path
                        d="M7.5 0.875C5.49797 0.875 3.875 2.49797 3.875 4.5C3.875 6.15288 4.98124 7.54738 6.49373 7.98351C5.2997 8.12901 4.27557 8.55134 3.50407 9.31167C2.52216 10.2794 2.02502 11.72 2.02502 13.5999C2.02502 13.8623 2.23769 14.0749 2.50002 14.0749C2.76236 14.0749 2.97502 13.8623 2.97502 13.5999C2.97502 11.8799 3.42786 10.7206 4.17091 9.9883C4.91536 9.25463 6.02674 8.87499 7.49995 8.87499C8.97317 8.87499 10.0846 9.25463 10.8291 9.98831C11.5721 10.7206 12.025 11.8799 12.025 13.5999C12.025 13.8623 12.2376 14.0749 12.5 14.0749C12.7623 14.075 12.975 13.8623 12.975 13.6C12.975 11.72 12.4778 10.2794 11.4959 9.31166C10.7244 8.55135 9.70025 8.12903 8.50625 7.98352C10.0187 7.5474 11.125 6.15289 11.125 4.5C11.125 2.49797 9.50203 0.875 7.5 0.875ZM4.825 4.5C4.825 3.02264 6.02264 1.825 7.5 1.825C8.97736 1.825 10.175 3.02264 10.175 4.5C10.175 5.97736 8.97736 7.175 7.5 7.175C6.02264 7.175 4.825 5.97736 4.825 4.5Z"
                        fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>Data Karyawan</a>
        </nav>
        <button type="button" onclick="toggleMobileSidebar()"
            class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none data-[state=open]:bg-secondary">
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
                <path
                    d="M11.7816 4.03157C12.0062 3.80702 12.0062 3.44295 11.7816 3.2184C11.5571 2.99385 11.193 2.99385 10.9685 3.2184L7.50005 6.68682L4.03164 3.2184C3.80708 2.99385 3.44301 2.99385 3.21846 3.2184C2.99391 3.44295 2.99391 3.80702 3.21846 4.03157L6.68688 7.49999L3.21846 10.9684C2.99391 11.193 2.99391 11.557 3.21846 11.7816C3.44301 12.0061 3.80708 12.0061 4.03164 11.7816L7.50005 8.31316L10.9685 11.7816C11.193 12.0061 11.5571 12.0061 11.7816 11.7816C12.0062 11.557 12.0062 11.193 11.7816 10.9684L8.31322 7.49999L11.7816 4.03157Z"
                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                </path>
            </svg>
            <span class="sr-only">Close</span>
        </button>
    </div>

    {{-- USER NAV MODAL --}}
    <div style="position: fixed; left: 0px; top: 0px; transform: translate(1288px, 55.5px); min-width: max-content;"
        class="bg-white">
        <div id="user-nav-modal" data-side="bottom" data-align="end" role="menu" data-state="closed"
            data-radix-menu-content="" dir="ltr" id="radix-:r4:" aria-labelledby="radix-:r3:"
            class="data-[state=closed]:hidden z-50 min-w-[8rem] overflow-hidden rounded-md border bg-popover p-1 text-popover-foreground shadow-md data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2"
            tabindex="-1">
            <div class="px-2 py-1.5 text-sm font-semibold"><a href="/profile">My Account</a></div>
            <div role="separator" class="-mx-1 my-1 h-px bg-muted"></div>
            <div role="menuitem"
                class="relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                Settings</div>
            <div role="menuitem"
                class="relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                Support</div>
            <div role="separator" class="-mx-1 my-1 h-px bg-muted"></div>
            <div role="menuitem"
                class="relative flex select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 cursor-pointer">
                Logout</div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function toggleMobileSidebar() {
            const sidebarModal = $('#sidebar-mobile-modal');
            const dataState = sidebarModal.attr('data-state');

            if (dataState === 'open') {
                sidebarModal.attr('data-state', 'closed');
            } else {
                sidebarModal.attr('data-state', 'open');
            }
        }

        function toggleUserNavModal() {
            console.log('sda')
            const userNavModal = $('#user-nav-modal');
            const dataState = userNavModal.attr('data-state');

            if (dataState === 'open') {
                userNavModal.attr('data-state', 'closed');
            } else {
                userNavModal.attr('data-state', 'open');
            }
        }
    </script>
</body>

</html>
