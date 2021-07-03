<?php

use leetcode\common\ListNode;

class Twitter {
    /**
     * Initialize your data structure here.
     */
    public $data = [];//数据
    public $struct = [
        'follower' => [],//关注者，
        'follow_post' => [],//关注的人发的推文
    ];

    function __construct() {
        //结构
        [
            'user_id' => [
                'follower' => [],//关注者，
                'follow_post' => [],//关注的人发的推文
            ]
        ];
    }

    /**
     * Compose a new tweet.
     * @param Integer $userId
     * @param Integer $tweetId
     * @return NULL
     */
    function postTweet($userId, $tweetId) {
        $node = new ListNode($tweetId);
        if ( !isset($this->data[$userId]) )
        {
            $this->data[$userId] = $this->struct;
        }

        foreach ($this->data[$userId]['follower'] as $follower_id)
        {
            if ( !isset($this->data[$follower_id]) )
            {
                $this->data[$follower_id] = $this->struct;
            }

            array_unshift($this->data[$follower_id]['follow_post'],$tweetId);
        }
    }

    /**
     * Retrieve the 10 most recent tweet ids in the user's news feed. Each item in the news feed must be posted by users who the user followed or by the user herself. Tweets must be ordered from most recent to least recent.
     * @param Integer $userId
     * @return Integer[]
     */
    function getNewsFeed($userId) {
        if ( !isset($this->data[$userId]) )
        {
            $this->data[$userId] = $this->struct;
        }
        return $this->data[$userId]['follow_post'];
    }

    /**
     * Follower follows a followee. If the operation is invalid, it should be a no-op.
     * @param Integer $followerId
     * @param Integer $followeeId
     * @return NULL
     */
    function follow($followerId, $followeeId) {
        if ( !isset($this->data[$followerId]) )
        {
            $this->data[$followerId] = $this->struct;
        }
        if ( !isset($this->data[$followeeId]) )
        {
            $this->data[$followeeId] = $this->struct;
        }
        $this->data[$followeeId]['follower'][$followerId] = $followerId;
    }

    /**
     * Follower unfollows a followee. If the operation is invalid, it should be a no-op.
     * @param Integer $followerId
     * @param Integer $followeeId
     * @return NULL
     */
    function unfollow($followerId, $followeeId) {
        if ( !isset($this->data[$followerId]) )
        {
            $this->data[$followerId] = $this->struct;
        }
        if ( !isset($this->data[$followeeId]) )
        {
            $this->data[$followeeId] = $this->struct;
        }
        if (isset($this->data[$followeeId]['follower'][$followerId]))
        {
            unset($this->data[$followeeId]['follower'][$followerId]);
        }
    }
}

/**
 * Your Twitter object will be instantiated and called as such:
 * $obj = Twitter();
 * $obj->postTweet($userId, $tweetId);
 * $ret_2 = $obj->getNewsFeed($userId);
 * $obj->follow($followerId, $followeeId);
 * $obj->unfollow($followerId, $followeeId);
 */

$a = ["Twitter","postTweet","getNewsFeed","follow","postTweet","getNewsFeed","unfollow","getNewsFeed"];
$b = [[],[1,5],[1],[1,2],[2,6],[1],[1,2],[1]];
$class = null;
foreach ($a as $k=>$v)
{
    if ($class == null && class_exists($v))
    {
        $class = new $v($b);
        continue;
    }
    $rp = new ReflectionClass (get_class($class) );
    $rp
}


