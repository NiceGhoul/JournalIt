<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\AchievementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Achievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Achievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Achievement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Achievement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Achievement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Achievement whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Achievement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Achievement whereUpdatedAt($value)
 */
	class Achievement extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Meditation|null $meditation
 * @property-read \App\Models\ToDoList|null $toDoList
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AnalyticFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Analytic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Analytic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Analytic query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Analytic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Analytic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Analytic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Analytic whereUserId($value)
 */
	class Analytic extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $date_added
 * @property string $status
 * @property string $logo
 * @property int $analytic_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Analytic|null $analytics
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\MeditationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation whereAnalyticId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation whereDateAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meditation whereUserId($value)
 */
	class Meditation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $date_added
 * @property string $status
 * @property string $logo
 * @property int $analytic_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Analytic|null $analytics
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ToDoListFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList whereAnalyticId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList whereDateAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ToDoList whereUserId($value)
 */
	class ToDoList extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $age
 * @property string $gender
 * @property string|null $profile_picture
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Achievement> $achievements
 * @property-read int|null $achievements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Analytic> $analytics
 * @property-read int|null $analytics_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meditation> $meditations
 * @property-read int|null $meditations_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ToDoList> $toDoLists
 * @property-read int|null $to_do_lists_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAchievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAchievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAchievement query()
 */
	class UserAchievement extends \Eloquent {}
}

