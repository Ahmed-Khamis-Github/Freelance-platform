<!-- Dashboard Headline -->
<div class="dashboard-headline">
    <h3>Post a Job</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Breadcrumbs -->
    <nav id="breadcrumbs" class="dark">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li>Post a Job</li>
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
                <h3><i class="icon-feather-folder-plus"></i> Job Submission Form</h3>
            </div>

            <div class="content with-padding padding-bottom-10">
                <div class="row">

                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Job Title</h5>
                            <input type="text" name="title" value="{{ old('name', $project->title) }}"
                                class="with-border">
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Job Type</h5>
                            <select name="type" class="selectpicker with-border" data-size="7"
                                title="Select Job Type">

                                @foreach ($types as $type)
                                    <option value="{{ $type }}" @selected($type == old('type', $project->type))>{{ $type }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Job Category</h5>
                            <select name="category_id" class="selectpicker with-border" data-size="7"
                                title="Select Category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == old('category_id', $project->category_id))>
                                        {{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>



                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Budget</h5>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="input-with-icon">
                                        <input class="with-border" type="text" name="budget"
                                            value="{{ old('name', $project->budget) }}">
                                        <i class="currency">USD</i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Tags <span>(optional)</span> <i class="help-icon" data-tippy-placement="right"
                                    title="Maximum of 10 tags"></i></h5>
                            <div class="keywords-container">
                                <div class="keyword-input-container">
                                    <input type="text" name="tags" value="{{ $tags }}"
                                        class="keyword-input with-border"
                                        placeholder="e.g. job title, responsibilites" />
                                    <button type="button" class="keyword-input-button ripple-effect"><i
                                            class="icon-material-outline-add"></i></button>
                                </div>
                                <div class="keywords-list">
                                    <!-- keywords go here -->
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="submit-field">
                            <h5>Job Description</h5>
                            <textarea cols="30" rows="5" class="with-border" name="description">{{ $project->description }}</textarea>
                            <div class="uploadButton margin-top-30">
                                <input class="uploadButton-input" type="file" name="attachments[]" id="upload"
                                    multiple />
                                <label class="uploadButton-button ripple-effect" for="upload">Upload Files</label>
                                <span class="uploadButton-file-name">Images or documents that might be helpful in
                                    describing your job</span>
                            </div>

 

                            @if (is_array($project->attachments))
                                <div>
                                    <ul>
                                        @foreach ($project->attachments as $file)
                                            @if (is_string($file))
                                                <li><a
                                                        href="{{ asset('uploads/' . $file) }}">{{ basename($file) }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <button type="submit" class="button ripple-effect big margin-top-30">Post a Job</button>
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
