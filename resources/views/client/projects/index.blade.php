<x-app-layout>

    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner">

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Manage Jobs</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li>Manage Jobs</li>
                    </ul>
                </nav>
            </div>

            <!-- Row -->
            <div class="row">

                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <div class="dashboard-box margin-top-0">

                        <!-- Headline -->
                        <div class="headline">
                            <h3><i class="icon-material-outline-business-center"></i> My Job Listings</h3>
                        </div>

                        <div class="content">
                            <ul class="dashboard-box-list">
 
                                @foreach ($projects as $project)
                                    <li>
                                        <!-- Job Listing -->
                                        <div class="job-listing">

                                            <!-- Job Listing Details -->
                                            <div class="job-listing-details">

                                                <!-- Details -->
                                                <div class="job-listing-description">
                                                    <h3 class="job-listing-title"><a
                                                            href="#">{{ $project->title }}</a> <span
                                                            class="dashboard-status-button green">{{ $project->status }}</span>
                                                    </h3>

                                                    <!-- Job Listing Footer -->
                                                    <div class="job-listing-footer">
                                                        <ul>
                                                            <li><i class="icon-material-outline-date-range"></i> Posted
                                                                on {{ $project->created_at }}</li>
                                                            <li><i class="icon-material-outline-date-range"></i>
                                                                Category: {{ $project->category->parent->name  }} /
                                                                {{ $project->category->name }}</li>
                                                            <li><i class="icon-material-outline-date-range"></i> Tags :
                                                                @foreach ($project->tags as $tag)
                                                                    {{ $tag->name }}
                                                                @endforeach
 
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Buttons -->
                                        <div class="buttons-to-right always-visible">
                                            <a href="dashboard-manage-candidates.html" class="button ripple-effect"><i
                                                    class="icon-material-outline-supervisor-account"></i> Manage
                                                Candidates <span class="button-info">7</span></a>
                                            <a href="#" class="button dark ripple-effect"><i
                                                    class="icon-feather-rotate-ccw"></i> Refresh</a>
                                            <a href="{{ route('client.projects.edit', $project->id) }}"
                                                class="button gray ripple-effect ico" title="Edit"
                                                data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
												<a href="javascript:;" class="button gray ripple-effect ico"
                                                    title="Remove" onclick="document.getElementById('form1').submit();"
                                                    data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>


                                            <form id="form1"
                                                action="{{ route('client.projects.destroy', $project->id) }}"
                                                method="post">

                                                @csrf

                                                @method('DELETE')
                                                
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Row / End -->

            <!-- Footer -->
            <div class="dashboard-footer-spacer"></div>
            <div class="small-footer margin-top-15">
                <div class="small-footer-copyrights">
                    © 2018 <strong>Hireo</strong>. All Rights Reserved.
                </div>
                <ul class="footer-social-links">
                    <li>
                        <a href="#" title="Facebook" data-tippy-placement="top">
                            <i class="icon-brand-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Twitter" data-tippy-placement="top">
                            <i class="icon-brand-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Google Plus" data-tippy-placement="top">
                            <i class="icon-brand-google-plus-g"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="LinkedIn" data-tippy-placement="top">
                            <i class="icon-brand-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Footer / End -->

        </div>
    </div>
</x-app-layout>
