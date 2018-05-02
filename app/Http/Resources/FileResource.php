<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Patient;
use App\Models\admin;
use Storage;

class FileResource extends JsonResource
{
    /**
     * Get image size from stored image
     *
     * @param  String $imagePath
     * @return Array
     */
    private function data2size($imagePath){
        $photo = Storage::get($imagePath);

        $size = getimagesizefromstring($photo);

        $dimentions = array();

        $dimentions[] = $size[0];
        $dimentions[] = $size[1];

        return $dimentions;
    }

     /**
     * Group all images created at the same time in an array
     *
     * @param  Array $images
     * @return array
     */
    public function groupImages($images)
    {
        for ($i = 0; $i < count($images); $i++) {
            $imageSize = $this->data2size($images[$i]->image);

            $images[$i]->width = $imageSize[0];
            $images[$i]->height = $imageSize[1];
        }

        if (count($images) > 1){
            $start = $images[0]->created_at;
            $group[] = $images[0];
            for ($i = 1; $i < count($images); $i++) {
                if ($images[$i]->created_at == $start) {
                    $group[] = $images[$i];
                    if($i == count($images) - 1){
                        $photos[] = $group;
                    }
                }
                else{
                    $photos[] = $group;
                    $group = null;
                    $group[] = $images[$i];
                    $start = $images[$i]->created_at;
                }
            }
        }
        else if(count($images) == 1) {
            $group[] = $images[0];
            $photos[] = $group;
        }
        else{
            $photos = null;
        }

        return $photos;
    }

    /**
     * Group all file elements to one array
     *
     * @param  Array $prescriptions
     * @param  Array $images
     * @param  Array $comments
     * @return array
     */
    public function arrays2pages($prescriptions, $images, $comments)
    {
        $pages = null;
        $sortedPages = null;
        $numPages = 0;

        for ($i = 0; $i < count($prescriptions); $i++) {
            $admin = Admin::find($prescriptions[$i]->admin_id);
            $page = array(
                "prescriptions" => $prescriptions[$i],
                "images" => null,
                "comments" => null,
                "doctorName" => $admin->name,
                "doctorEmail" => $admin->email,
                "creationDate" => $prescriptions[$i]->created_at
            );
            $sortedPages[] = $prescriptions[$i]->created_at;

            for ($j = 0; $j < count($images); $j++) {
                $image = $images[$j];
                if($image != null) {
                    if ($image[0]->created_at == $prescriptions[$i]->created_at) {
                        $page["images"] = $image;
                        $images[$j] = null;
                        break;
                    }
                }
            }

            for ($j = 0; $j < count($comments); $j++) {
                if($comments[$j] != null) {
                    if ($comments[$j]->created_at == $prescriptions[$i]->created_at) {
                        $page["comments"] = $comments[$j];
                        $comments[$j] = null;
                        break;
                    }
                }
            }

            $pages["page_" . ++$numPages] = $page;
        }

        for ($i = 0; $i < count($images); $i++) {
            if ($images[$i] != null) {
                $image = $images[$i];
                $admin = Admin::find($image[0]->admin_id);
                $page = array(
                    "prescriptions" => null,
                    "images" => $image,
                    "comments" => null,
                    "doctorName" => $admin->name,
                    "doctorEmail" => $admin->email,
                    "creationDate" => $image[0]->created_at
                );
                
                $sortedPages[] = $image[0]->created_at;

                for ($j = 0; $j < count($images); $j++) {
                    if ($comments[$j] != null) {
                        if ($comments[$j]->created_at == $image[0]->created_at) {
                            $page["comments"] = $comments[$j];
                            $comments[$j] = null;
                            break;
                        }
                    }
                }

                $pages["page_" . ++$numPages] = $page;
            }
        }

        foreach ($comments as $comment) {
            if ($comment != null) {
                $admin = Admin::find($comment->admin_id);
                $sortedPages[] = $comment->created_at;
                $pages["page_" . ++$numPages] = array(
                    "prescriptions" => null,
                    "images" => null,
                    "comments" => $comment,
                    "doctorName" => $admin->name,
                    "doctorEmail" => $admin->email,
                    "creationDate" => $comment->created_at
                );
            }
        }

        return array($pages, $sortedPages);
    }

    /**
     * Sort pages with creation time
     *
     * @param  Array $sort
     * @param  Array $pages
     * @return array
     */
    public function sortPages($sort, $pages){
        $sortedPages = null;
        $numPages = 0;

        sort($sort, SORT_REGULAR);

        foreach ($sort as $s) {
            foreach($pages as $page){
                if ($page["prescriptions"] != null){
                    if ($s == $page["prescriptions"]->created_at){
                        $sortedPages["page_" . ++$numPages] = $page;
                        break;
                    }
                }
                else if ($page["images"] != null) {
                    $p = $page["images"];
                    if ($s == $p[0]->created_at){
                        $sortedPages["page_" . ++$numPages] = $page;
                        break;
                    }
                }
                else{
                    if ($s == $page["comments"]->created_at){
                        $sortedPages["page_" . ++$numPages] = $page;
                        break;
                    }
                }
            }
        }

        return $sortedPages;
    }

    /**
     * Create pages array from prescriptions, images and comments
     *
     * @param  Patient $patient
     * @return array
     */
    public function get_pages($patient){
        $prescriptions = $patient->prescriptions;
        $images = $this->groupImages($patient->images);
        $comments = $patient->comments;
        
        $pages = $this->arrays2pages($prescriptions, $images, $comments);
        
        $pages = $this->sortPages($pages[1], $pages[0]);

        return $pages;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $prescriptions = $this->prescriptions;
        $images = $this->groupImages($this->images);
        $comments = $this->comments;
        
        $pages = $this->arrays2pages($prescriptions, $images, $comments);
        
        $pages = $this->sortPages($pages[1], $pages[0]);

        return $pages;
    }
}
