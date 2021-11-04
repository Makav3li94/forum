<?php


namespace App\Models;


trait RecordActivity
{

    protected static function bootRecordActivity()
    {
        if (auth()->guest()) return;
        foreach (static::getRecordEvents() as $event){
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected function getActiviryType($event)
    {
        return $event . '_' . strtolower((New \ReflectionClass($this))->getShortName());
    }

    protected static function getRecordEvents(){
        return ['created'];
    }

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActiviryType($event),
        ]);
    }

    public function activity()
    {
        return $this->morphMany(Activity::class,'subject');
    }

}