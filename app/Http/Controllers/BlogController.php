<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\tag;
use App\Models\category;
use App\Models\keyword;
use App\Models\alttag;
use App\Http\Requests\StoreblogRequest;
use App\Http\Requests\UpdateblogRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\seodetails;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manageblog()
    {
        $blogs = blog::get();
        $blogitems = [];
        foreach ($blogs as $blogdata) {

            $cataegoryid = explode(",", $blogdata->category);
            $categories = [];
            foreach ($cataegoryid as $id) {
                $category = category::where('id', $id)->first();
                $categories[$id] = $category->category;
            }
            $blogitems[$blogdata->language][$blogdata->id]['category'] = $categories;

            $keywordid = explode(",", $blogdata->keyword);
            $keywords = [];
            foreach ($keywordid as $id) {
                $keyword = keyword::where('id', $id)->first();
                $keywords[$id] = $keyword->keyword;
            }
            $blogitems[$blogdata->language][$blogdata->id]['keyword'] = $keywords;

            $tagid = explode(",", $blogdata->tags);
            $tags = [];
            foreach ($tagid as $id) {
                $tag = tag::where('id', $id)->first();
                $tags[$id] = $tag->tag;
            }
            $blogitems[$blogdata->language][$blogdata->id]['tag'] = $tags;
            $blogitems[$blogdata->language][$blogdata->id]['description'] = html_entity_decode($blogdata->description);
            $blogitems[$blogdata->language][$blogdata->id]['title'] = $blogdata->title;

            // $find = array('_', '#', '$', '@', ',', '.', '\'', ';', ':', '"', '[', ']', '{', '}', '(', ')', '<', '>', '?', '%', '^', '&', '*', '+', '=', '!', '~', '`', '|', '\\', '/');

            // $nameurl = str_replace($find, "", $blogdata->title);
            // $nameurl = str_replace(" ", "-", strtolower(trim($nameurl)));
            // $nameurl = str_replace("&", "and", $nameurl);

            // $blogitems[$blogdata->language][$blogdata->id]['nameurl'] = $nameurl;

            $blogitems[$blogdata->language][$blogdata->id]['id'] = $blogdata->id;
            $blogitems[$blogdata->language][$blogdata->id]['language'] = $blogdata->language;
            $blogitems[$blogdata->language][$blogdata->id]['image'] = $blogdata->image;
        }
        //dd($blogitems);

        return view('admin.manageblog', ['page_name' => 'manageblog', 'navstatus' => "manageblog", "blogsdata" => $blogitems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addblog(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        $language = "";
        if ($request->language == "1") {
            $language = 'English';
        } else {
            $language = $request->language;
        }

        if (!empty($request->newtags)) {
            $tagdata = explode(",", $request->newtags);
        } else {
            $tagdata = [];
        }

        if (!empty($request->tags)) {
            $oldtag = $request->tags;
            $tagsdata = array_merge($oldtag, $tagdata);
        } else {
            $tagsdata = $tagdata;
        }

        if (!empty($tagsdata)) {
            $tagid = [];
            $i = 0;
            foreach ($tagsdata as $tag) {
                $ifdata = tag::where('tag', '=', $tag)->first();
                if ($ifdata === null) {
                    $savetag = new tag;
                    $savetag->tag = $tag;
                    $savetag->language = $language;
                    $savetag->save();
                    $tagid[$i] = $savetag->id;
                    $i++;
                } else {
                    $tagid[$i] = $ifdata->id;
                    $i++;
                }
            }
        } else {
            session(['status' => "0", 'msg' => 'tag not selected']);
            return redirect()->back();
        }

        if (!empty($request->newkeyword)) {
            $keyworddata = explode(",", $request->newkeyword);
        } else {
            $keyworddata = [];
        }
        if (!empty($request->keyword)) {
            $oldkeyword = $request->keyword;
            $keywordsdata = array_merge($oldkeyword, $keyworddata);
        } else {
            $keywordsdata = $keyworddata;
        }

        if (!empty($keywordsdata)) {
            $keywordid = [];
            $k = 0;
            foreach ($keywordsdata as $keyword) {
                $ifdata = keyword::where('keyword', '=', $keyword)->first();
                if ($ifdata === null) {
                    $savekeyword = new keyword;
                    $savekeyword->keyword = $keyword;
                    $savekeyword->language = $language;
                    $savekeyword->save();
                    $keywordid[$k] = $savekeyword->id;
                    $k++;
                } else {
                    $keywordid[$k] = $ifdata->id;
                    $k++;
                }
            }
        } else {
            session(['status' => "0", 'msg' => 'tag not selected']);
            return redirect()->back();
        }

        if (!empty($request->newcategory)) {
            $categorydata = explode(",", $request->newcategory);
        } else {
            $categorydata = [];
        }
        if (!empty($request->category)) {
            $oldcategory = $request->category;
            $categoriesdata = array_merge($oldcategory, $categorydata);
        } else {
            $categoriesdata = $categorydata;
        }

        if (!empty($categoriesdata)) {
            $categoryid = [];
            $c = 0;
            foreach ($categoriesdata as $category) {
                $ifdata = category::where('category', '=', $category)->first();
                if ($ifdata === null) {
                    $savecategory = new category;
                    $savecategory->category = $category;
                    $savecategory->language = $language;
                    $savecategory->save();
                    $categoryid[$c] = $savecategory->id;
                    $c++;
                } else {
                    $categoryid[$c] = $ifdata->id;
                    $c++;
                }
            }
        } else {
            session(['status' => "0", 'msg' => 'tag not selected']);
            return redirect()->back();
        }

        $find = array('_', '#', '$', '@', ',', '.', '\'', ';', ':', '"', '[', ']', '{', '}', '(', ')', '<', '>', '?', '%', '^', '&', '*', '+', '=', '!', '~', '`', '|', '\\', '/');

        $nameurl = str_replace($find, "", $request->nameurl);
        $nameurl = str_replace(" ", "-", strtolower(trim($nameurl)));

        //dd($nameurl);
        $nameurl = str_replace("&", "and", $nameurl);

        if (blog::where('nameurl', '=', $nameurl)->exists()) {
            session(['status' => "0", 'msg' => 'Blog name already exists']);
        } else {

            $tagid = implode(",", $tagid);
            $keywordid = implode(",", $keywordid);
            $categoryid = implode(",", $categoryid);
            $newblog = new blog;
            $newblog->tags = $tagid;
            $newblog->keyword = $keywordid;
            $newblog->category = $categoryid;
            $newblog->title = $request->name;
            $newblog->language = $language;
            $newblog->nameurl = $nameurl;
            $newblog->description = htmlentities($request->blogdescription);

            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
                ]);
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = 'Blog' . time() . '.' . $ext;
                $image = Image::read($file);
                // Resize image

                // resize image canvas
                // $image->resizeCanvas(1920, 1080);
                $image->resize(1920, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                });

                // $file = $request->file('image');
                // $ext = $file->getClientOriginalExtension();
                // $filename = 'Blog' . time() . '.' . $ext;
                // $file->move(public_path('blog'), $filename);
                if ($image->save(public_path('blog') . '/' . $filename)) {
                    $newblog->image = $filename;
                    // dd($newblog);
                }
            }
            //dd($newblog);
            if ($newblog->save()) {
                session(['status' => "1", 'msg' => 'Blog Add is successful']);
            } else {
                session(['status' => "0", 'msg' => 'Blog data is not Added']);
            }
        }
        return redirect()->back();
    }

    /**
     * show only one blog .
     */
    public function blog($nameurl)
    {
        //dd($nameurl);
        $blogs = blog::where('nameurl', $nameurl)->first();

        $category = explode(',', $blogs->category);
        $similarblog = [];
        $i = 1;
        foreach ($category as $cat) {
            $catblog = blog::where(
                'category',
                'like',
                '%' . $cat . '%'
            )->inRandomOrder()->limit(4)->get();
            foreach ($catblog as $similar) {
                $similarblog[$i] = $similar;
                $i++;
            }
        }

        $blogitems = [];
        foreach ($similarblog as $blogdata) {

            $cataegoryid = explode(",", $blogdata->category);
            $categories = [];
            foreach ($cataegoryid as $id) {
                $category = category::where('id', $id)->first();
                $categories[$id] = $category->category;
            }
            $blogitems[$blogdata->id]['category'] = $categories;

            $keywordid = explode(",", $blogdata->keyword);
            $keywords = [];

            foreach ($keywordid as $id) {
                $keyword = keyword::where('id', $id)->first();
                $keywords[$id] = $keyword->keyword;
            }
            $blogitems[$blogdata->id]['keyword'] = $keywords;

            $tagid = explode(",", $blogdata->tags);
            $tags = [];

            foreach ($tagid as $id) {
                $tag = tag::where('id', $id)->first();
                $tags[$id] = $tag->tag;
            }

            $blogitems[$blogdata->id]['tag'] = $tags;
            $blogitems[$blogdata->id]['description'] = html_entity_decode($blogdata->description);
            $blogitems[$blogdata->id]['title'] = $blogdata->title;

            // $find = array('_', '#', '$', '@', ',', '.', '\'', ';', ':', '"', '[', ']', '{', '}', '(', ')', '<', '>', '?', '%', '^', '&', '*', '+', '=', '!', '~', '`', '|', '\\', '/');
            // $nameurl = str_replace($find, "", $blogdata->nameurl);
            // $nameurl = str_replace(" ", "-", strtolower(trim($nameurl)));
            // $nameurl = str_replace("&", "and", $nameurl);

            $blogitems[$blogdata->id]['nameurl'] = $blogdata->nameurl;
            $blogitems[$blogdata->id]['id'] = $blogdata->id;
            if (!empty($blogdata->image)) {
                $blogitems[$blogdata->id]['image'] = $blogdata->image;
            } else {
                $blogitems[$blogdata->id]['image'] = 'noimage.jpg';
            }
            $createdat = $blogdata->created_at;
            $blogitems[$blogdata->id]['createdat'] = $blogdata->created_at->format('d F, Y');
        }
        //dd($blogitems);
        return view('front.soloblog', ["blogsdata" => $blogs, 'blogitems' => $blogitems]);
    }

    /**
     * Display the specified resource.
     */
    public function bloglist(blog $blog)
    {
        // blog details
        $limit = 6;
        $blogs = blog::limit($limit)->get();
        $blogcount = blog::count();
        $pagination = $blogcount / $limit;
        $pagination = ceil($pagination);
        //dd($pagination);
        $blogitems = [];
        foreach ($blogs as $blogdata) {

            $cataegoryid = explode(",", $blogdata->category);
            $categories = [];
            foreach ($cataegoryid as $id) {
                $category = category::where('id', $id)->first();
                $categories[$id] = $category->category;
            }
            $blogitems[$blogdata->id]['category'] = $categories;
            $keywordid = explode(",", $blogdata->keyword);

            $keywords = [];
            foreach ($keywordid as $id) {
                $keyword = keyword::where('id', $id)->first();
                $keywords[$id] = $keyword->keyword;
            }
            $blogitems[$blogdata->id]['keyword'] = $keywords;

            $tagid = explode(",", $blogdata->tags);
            $tags = [];
            foreach ($tagid as $id) {
                $tag = tag::where('id', $id)->first();
                $tags[$id] = $tag->tag;
            }
            $blogitems[$blogdata->id]['tag'] = $tags;

            $blogitems[$blogdata->id]['description'] = html_entity_decode($blogdata->description);
            $blogitems[$blogdata->id]['title'] = $blogdata->title;

            // $find = array('_', '#', '$', '@', ',', '.', '\'', ';', ':', '"', '[', ']', '{', '}', '(', ')', '<', '>', '?', '%', '^', '&', '*', '+', '=', '!', '~', '`', '|', '\\', '/');

            // $nameurl = str_replace($find, "", $blogdata->nameurl);
            // $nameurl = str_replace(" ", "-", strtolower(trim($nameurl)));
            // $nameurl = str_replace("&", "and", $nameurl);

            $blogitems[$blogdata->id]['nameurl'] = $blogdata->nameurl;
            $blogitems[$blogdata->id]['id'] = $blogdata->id;

            if (!empty($blogdata->image)) {
                $blogitems[$blogdata->id]['image'] = $blogdata->image;
            } else {
                $blogitems[$blogdata->id]['image'] = 'noimage.jpg';
            }
            $createdat = $blogdata->created_at;
            $blogitems[$blogdata->id]['createdat'] = $blogdata->created_at->format('d F, Y');
        }

        //dd($blogitems);
        return view('front.bloglist', ["blogitems" => $blogitems, 'pagination' => $pagination, 'page' => 1]);
    }

    public function languagefilter(Request $request)
    {
        $data = $request;
        $language = $data->language;
        // blog details
        $limit = 6;
        $blogfilters = [];
        $alltag = [];
        $allkeyword = [];
        $allcategory = [];

        if ($language == "all") {
            $blogs = blog::limit($limit)->get();
            $blogcount = blog::count();

            $alltags = tag::select('id', 'tag')->get();
            $allkeywords = keyword::select('id', 'keyword')->get();
            $allcategories = category::select('id', 'category')->get();
        } else {
            $blogs = blog::where('language', '=', $language)->limit($limit)->get();
            $blogcount = blog::where('language', '=', $language)->count();

            if ($blogcount === 0) {
                $alltags = tag::select('id', 'tag')->get();
                $allkeywords = keyword::select('id', 'keyword')->get();
                $allcategories = category::select('id', 'category')->get();
            } else {
                $alltags = tag::select('id', 'tag')->where('language', '=', $language)->get();
                $allkeywords = keyword::select('id', 'keyword')->where('language', '=', $language)->get();
                $allcategories = category::select('id', 'category')->where('language', '=', $language)->get();
            }
        }

        foreach ($alltags as $tag) {
            $alltag[$tag->id] = $tag->tag;
        }
        $blogfilters['alltag'] = $alltag;

        foreach ($allkeywords as $keyword) {
            $allkeyword[$keyword->id] = $keyword->keyword;
        }
        $blogfilters['allkeyword'] = $allkeyword;

        foreach ($allcategories as $category) {
            $allcategory[$category->id] = $category->category;
        }

        $blogfilters['allcategory'] = $allcategory;


        $pagination = $blogcount / $limit;
        $pagination = ceil($pagination);

        $blogitems = [];
        $i = 0;
        foreach ($blogs as $blogdata) {

            $cataegoryid = explode(",", $blogdata->category);
            $categories = [];

            foreach ($cataegoryid as $id) {
                $category = category::where('id', $id)->first();
                $categories[$id] = $category->category;
            }

            $blogitems[$blogdata->id]['category'] = $categories;
            $keywordid = explode(",", $blogdata->keyword);
            $keywords = [];

            foreach ($keywordid as $id) {
                $keyword = keyword::where('id', $id)->first();
                $keywords[$id] = $keyword->keyword;
            }
            $blogitems[$blogdata->id]['keyword'] = $keywords;

            $tagid = explode(",", $blogdata->tags);
            $tags = [];
            foreach ($tagid as $id) {
                $tag = tag::where('id', $id)->first();
                $tags[$id] = $tag->tag;
            }
            $blogitems[$blogdata->id]['tag'] = $tags;
            $blogitems[$blogdata->id]['description'] = html_entity_decode($blogdata->description);
            $blogitems[$blogdata->id]['title'] = $blogdata->title;

            // $find = array('_', '#', '$', '@', ',', '.', '\'', ';', ':', '"', '[', ']', '{', '}', '(', ')', '<', '>', '?', '%', '^', '&', '*', '+', '=', '!', '~', '`', '|', '\\', '/');
            // $nameurl = str_replace($find, "", $blogdata->nameurl);
            // $nameurl = str_replace(" ", "-", strtolower(trim($nameurl)));
            // $nameurl = str_replace("&", "and", $nameurl);

            $blogitems[$blogdata->id]['nameurl'] = $blogdata->nameurl;
            $blogitems[$blogdata->id]['id'] = $blogdata->id;

            if (!empty($blogdata->image)) {
                $blogitems[$blogdata->id]['image'] = $blogdata->image;
            } else {
                $blogitems[$blogdata->id]['image'] = 'noimage.jpg';
            }
            $blogitems[$blogdata->id]['createdate'] = $blogdata->created_at->format('d F, Y');
            if ($i == $limit) {
                exit;
            }
            $i++;
        }
        //dd($blogitems);
        if (count($blogitems) != 0) {
            print_r(json_encode(['status' => 1, 'blogitems' => $blogitems, 'blogfilters' => $blogfilters, 'pagination' => $pagination, 'page' => 1]));
        } else {
            print_r(json_encode(['status' => 0, 'blogfilters' => $blogfilters, 'message' => "No blog found"]));
        }
    }

    public function bloglistpagination($page, $language, $search, $type)
    {
        // blog details
        $limit = 6;
        $countpage = $page - 1;
        $offset = $limit * $countpage;

        if ($language == "all") {

            if ($type == 'all') {
                $blogs = blog::offset($offset)->limit($limit)->get();
                $blogcount = blog::count();
            } else if ($type == 'created_at') {

                $year = [];
                $year = explode('-', $search);
                $year = array_reverse($year);
                $yearmonth = implode('-', $year);

                $blogs = blog::where('created_at', 'like', '%' . $yearmonth . '%')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
                $blogcount = blog::where('created_at', 'like', '%' . $yearmonth . '%')
                    ->count();
            } else if ($type == 'title') {

                $blogs = blog::where($type, 'like', '%' . $search . '%')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
                $blogcount = blog::where($type, 'like', '%' . $search . '%')
                    ->count();
            } else {

                $search1 = '%' . ',' . $search . ',' . '%';
                $search2 = $search . ',' . '%';
                $search3 = '%,' . $search;

                $blogs = blog::where($type, '=', $search)
                    ->orWhere($type, 'like', $search1)
                    ->orWhere($type, 'like', $search2)
                    ->orWhere($type, 'like', $search3)
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
                $blogcount = blog::where($type, '=', $search)
                    ->orWhere($type, 'like', $search1)
                    ->orWhere($type, 'like', $search2)
                    ->orWhere($type, 'like', $search3)
                    ->count();
            }
        } else {

            if ($type == 'all') {
                $blogs = blog::where('language', '=', $language)
                    ->offset($offset)
                    ->limit($limit)->get();

                $blogcount = blog::where('language', '=', $language)
                    ->count();
            } else if ($type == 'created_at') {
                $year = [];
                $year = explode('-', $search);
                $year = array_reverse($year);
                $yearmonth = implode('-', $year);
                $blogs = blog::where([
                    ['created_at', 'like', '%' . $yearmonth . '%'],
                    ['language', '=', $language]
                ])
                    ->offset($offset)
                    ->limit($limit)
                    ->get();

                $blogcount = blog::where([
                    ['created_at', 'like', '%' . $yearmonth . '%'],
                    ['language', '=', $language]
                ])
                    ->count();
            } else if ($type == 'title') {

                $blogs = blog::where([
                    [$type, 'like', '%' . $search . '%'],
                    ['language', '=', $language]
                ])
                    ->offset($offset)
                    ->limit($limit)
                    ->get();

                $blogcount = blog::where([
                    [$type, 'like', '%' . $search . '%'],
                    ['language', '=', $language]
                ])
                    ->count();
            } else {

                $search1 = '%' . ',' . $search . ',' . '%';
                $search2 = $search . ',' . '%';
                $search3 = '%,' . $search;

                $blogs = blog::where([
                    [$type, '=', $search],
                    ['language', '=', $language]
                ])
                    ->orWhere($type, 'like', $search1)
                    ->orWhere($type, 'like', $search2)
                    ->orWhere($type, 'like', $search3)
                    ->offset($offset)
                    ->limit($limit)
                    ->get();

                $blogcount = blog::where([
                    [$type, '=', $search],
                    ['language', '=', $language]
                ])
                    ->orWhere($type, 'like', $search1)
                    ->orWhere($type, 'like', $search2)
                    ->orWhere($type, 'like', $search3)
                    ->count();
            }
        }

        //dd($blogs);
        $pagination = $blogcount / $limit;
        $pagination = ceil($pagination);

        //dd($pagination);
        $blogitems = [];
        foreach ($blogs as $blogdata) {

            $cataegoryid = explode(",", $blogdata->category);
            $categories = [];
            foreach ($cataegoryid as $id) {
                $category = category::where('id', $id)->first();
                $categories[$id] = $category->category;
            }
            $blogitems[$blogdata->id]['category'] = $categories;

            $keywordid = explode(",", $blogdata->keyword);
            $keywords = [];

            foreach ($keywordid as $id) {
                $keyword = keyword::where('id', $id)->first();
                $keywords[$id] = $keyword->keyword;
            }
            $blogitems[$blogdata->id]['keyword'] = $keywords;

            $tagid = explode(",", $blogdata->tags);
            $tags = [];
            foreach ($tagid as $id) {
                $tag = tag::where('id', $id)->first();
                $tags[$id] = $tag->tag;
            }
            $blogitems[$blogdata->id]['tag'] = $tags;

            $blogitems[$blogdata->id]['description'] = html_entity_decode($blogdata->description);
            $blogitems[$blogdata->id]['title'] = $blogdata->title;

            // $find = array('_', '#', '$', '@', ',', '.', '\'', ';', ':', '"', '[', ']', '{', '}', '(', ')', '<', '>', '?', '%', '^', '&', '*', '+', '=', '!', '~', '`', '|', '\\', '/');

            // $nameurl = str_replace($find, "", $blogdata->title);
            // $nameurl = str_replace(" ", "-", strtolower(trim($nameurl)));
            // $nameurl = str_replace("&", "and", $nameurl);

            $blogitems[$blogdata->id]['nameurl'] = $blogdata->nameurl;
            $blogitems[$blogdata->id]['id'] = $blogdata->id;

            if (!empty($blogdata->image)) {
                $blogitems[$blogdata->id]['image'] = $blogdata->image;
            } else {
                $blogitems[$blogdata->id]['image'] = 'noimage.jpg';
            }

            $blogitems[$blogdata->id]['createdate'] = $blogdata->created_at->format('d F, Y');
        }

        //dd(count($blogitems));
        if (count($blogitems) == 0) {
            print_r(json_encode(['status' => 0, 'message' => "No blog found"]));
        } else {
            print_r(json_encode(['status' => 1, 'blogitems' => $blogitems, 'pagination' => $pagination, 'page' => $page]));
        }
    }

    /**
     * show only one blog .
     */
    public function searchblog(Request $request)
    {
        $data = $request;

        $search = $data->search;
        $type = $data->type;
        if ($type == 'created_at') {

            $year = [];
            $year = explode('-', $search);
            $year = array_reverse($year);
            $yearmonth = implode('-', $year);
            $blogs = blog::where(
                'created_at',
                'like',
                '%' . $yearmonth . '%'
            )->get();
        } else if ($type == 'title') {
            $blogs = blog::where(
                $type,
                'like',
                '%' . $search . '%'
            )->get();
        } else {
            $search1 = '%' . ',' . $search . ',' . '%';
            $search2 = $search . ',' . '%';
            $search3 = '%,' . $search;

            $blogs = blog::where($type, '=', $search)
                ->orWhere($type, 'like', $search1)
                ->orWhere($type, 'like', $search2)
                ->orWhere($type, 'like', $search3)
                ->get();
        }

        $limit = 6;
        $blogcount = count($blogs);
        $pagination = $blogcount / $limit;
        $pagination = ceil($pagination);

        $blogitems = [];
        //dd($blogs);
        foreach ($blogs as $blogdata) {

            $cataegoryid = explode(",", $blogdata->category);
            $categories = [];
            foreach ($cataegoryid as $id) {
                $category = category::where('id', $id)->first();
                $categories[$id] = $category->category;
            }
            $blogitems[$blogdata->id]['category'] = $categories;

            $keywordid = explode(",", $blogdata->keyword);
            $keywords = [];
            foreach ($keywordid as $id) {
                $keyword = keyword::where('id', $id)->first();
                $keywords[$id] = $keyword->keyword;
            }
            $blogitems[$blogdata->id]['keyword'] = $keywords;

            $tagid = explode(",", $blogdata->tags);

            $tags = [];

            foreach ($tagid as $id) {
                $tag = tag::where('id', $id)->first();
                $tags[$id] = $tag->tag;
            }

            $blogitems[$blogdata->id]['tag'] = $tags;

            //$blogitems[$blogdata->id]['description'] = substr(strip_tags(html_entity_decode($blogdata->description)), 0, 120);
            $blogitems[$blogdata->id]['description'] = strip_tags(html_entity_decode($blogdata->description));
            $blogitems[$blogdata->id]['title'] = $blogdata->title;

            // $find = array('_', '#', '$', '@', ',', '.', '\'', ';', ':', '"', '[', ']', '{', '}', '(', ')', '<', '>', '?', '%', '^', '&', '*', '+', '=', '!', '~', '`', '|', '\\', '/');

            // $nameurl = str_replace($find, "", $blogdata->title);
            // $nameurl = str_replace(" ", "-", strtolower(trim($nameurl)));
            // $nameurl = str_replace("&", "and", $nameurl);

            $blogitems[$blogdata->id]['nameurl'] = $blogdata->nameurl;
            $blogitems[$blogdata->id]['id'] = $blogdata->id;

            if (!empty($blogdata->image)) {
                $blogitems[$blogdata->id]['image'] = $blogdata->image;
            } else {
                $blogitems[$blogdata->id]['image'] = 'noimage.jpg';
            }

            $blogitems[$blogdata->id]['createdate'] = $blogdata->created_at->format('d F, Y');
        }

        $blogitems = array_slice($blogitems, 0, $limit);

        if (count($blogitems) != 0) {
            print_r(json_encode(['status' => 1, 'blogitems' => $blogitems, 'pagination' => $pagination, 'page' => 1]));
        } else {
            print_r(json_encode(['status' => 0, 'message' => "No blog found"]));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editblog($id)
    {
        $id = base64_decode($id);
        $blogs = blog::where('id', $id)->first();
        //dd($blogs);
        //dd($allcategory);
        return view('admin.editblog', ['page_name' => 'manageblog', 'navstatus' => "manageblog", "blogsdata" => $blogs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateblog(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        if (!empty($request->newtags)) {
            $tagdata = explode(",", $request->newtags);
        } else {
            $tagdata = [];
        }
        if (!empty($request->tags)) {
            $oldtag = $request->tags;
            $tagsdata = array_merge($oldtag, $tagdata);
        } else {
            $tagsdata = $tagdata;
        }

        $tagid = [];
        $i = 0;
        foreach ($tagsdata as $tag) {
            $ifdata = tag::where('tag', '=', $tag)->first();
            if ($ifdata === null) {
                $savetag = new tag;
                $savetag->tag = $tag;
                $savetag->save();
                $tagid[$i] = $savetag->id;
                $i++;
            } else {
                $tagid[$i] = $ifdata->id;
                $i++;
            }
        }

        if (!empty($request->newkeyword)) {
            $keyworddata = explode(",", $request->newkeyword);
        } else {
            $keyworddata = [];
        }
        if (!empty($request->keyword)) {
            $oldkeyword = $request->keyword;
            $keywordsdata = array_merge($oldkeyword, $keyworddata);
        } else {
            $keywordsdata = $keyworddata;
        }
        $keywordid = [];
        $k = 0;
        foreach ($keywordsdata as $keyword) {
            $ifdata = keyword::where('keyword', '=', $keyword)->first();
            if ($ifdata === null) {
                $savekeyword = new keyword;
                $savekeyword->keyword = $keyword;
                $savekeyword->save();
                $keywordid[$k] = $savekeyword->id;
                $k++;
            } else {
                $keywordid[$k] = $ifdata->id;
                $k++;
            }
        }

        if (!empty($request->newcategory)) {
            $categorydata = explode(",", $request->newcategory);
        } else {
            $categorydata = [];
        }
        if (!empty($request->category)) {
            $oldcategory = $request->category;
            $categoriesdata = array_merge($oldcategory, $categorydata);
        } else {
            $categoriesdata = $categorydata;
        }
        $categoryid = [];
        $c = 0;
        foreach ($categoriesdata as $category) {
            $ifdata = category::where('category', '=', $category)->first();
            if ($ifdata === null) {
                $savecategory = new category;
                $savecategory->category = $category;
                $savecategory->save();
                $categoryid[$c] = $savecategory->id;
                $c++;
            } else {
                $categoryid[$c] = $ifdata->id;
                $c++;
            }
        }

        $find = array('_', '#', '$', '@', ',', '.', '\'', ';', ':', '"', '[', ']', '{', '}', '(', ')', '<', '>', '?', '%', '^', '&', '*', '+', '=', '!', '~', '`', '|', '\\', '/');

        $nameurl = str_replace($find, "", $request->nameurl);
        $nameurl = str_replace(" ", "-", strtolower(trim($nameurl)));
        $nameurl = str_replace("&", "and", $nameurl);

        if (blog::where([['nameurl', '=', $nameurl], ['id', '!=', $request->id]])->exists()) {
            // data found
            session(['status' => "0", 'msg' => 'Blog name already exists']);
        } else {
            // data not found

            //dd($categoryid);
            $tagid = implode(",", $tagid);
            $keywordid = implode(",", $keywordid);
            $categoryid = implode(",", $categoryid);

            $updateblog['tags'] = $tagid;
            $updateblog['keyword'] = $keywordid;
            $updateblog['category'] = $categoryid;
            $updateblog['title'] = $request->name;
            $updateblog['language'] = $request->language;
            $updateblog['nameurl'] = $nameurl;
            $updateblog['description'] = htmlentities($request->blogdescription);

            if ($request->hasFile('newimage')) {

                $request->validate([
                    'newimage' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
                ]);

                $file = $request->file('newimage');
                $ext = $file->getClientOriginalExtension();
                $filename = 'Blog' . time() . '.' . $ext;
                $image = Image::read($file);
                // Resize image

                // resize image canvas
                // $image->resizeCanvas(1920, 1080);
                $image->resize(1920, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                });
                if ($image->save(public_path('blog') . '/' . $filename)) {
                    $image = public_path('about') . '/' . $request->oldimage;
                    if ($request->oldimage != null) {
                        if (file_exists($request->oldimage)) {
                            // delete old image if exist
                            unlink($image);
                        }
                    }
                    $updateblog['image'] = $filename;
                }
            } else {
                $updateblog['image'] = $request->oldimage;
            }
            //dd($updateblog);
            $update = blog::where('id', $request->id)
                ->update($updateblog);

            if ($update) {
                session(['status' => "1", 'msg' => 'Blog update is successful']);
            } else {
                session(['status' => "0", 'msg' => 'Blog data is not Updated']);
            }
        }
        return redirect('/manageblog');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteblog(Request $request)
    {
        $id = base64_decode($request->id);
        if (!empty($request->blogimage)) {
            $image = public_path('blog') . '/' . $request->blogimage;
        }

        //echo json_encode(array('status' => 1, 'msg' => $id));
        $blog = blog::where('id', $id)->delete();
        $altblog = alttag::where([['relatedid', $id], ['page', 'blog']])->delete();
        $seoblog = seodetails::where([['relatedid', $id], ['page', 'blog']])->delete();
        if ($blog) {
            if (file_exists($image)) {
                unlink($image);
            }
            echo json_encode(array('status' => 1, 'msg' => "true"));
        } else {
            echo json_encode(array('status' => 0, 'msg' => "false"));
        }
    }
}