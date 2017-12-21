<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\game;

/**
 * GameSearch represents the model behind the search form about `app\models\game`.
 */
class GameSearch extends game
{
	
	public $yearFrom;
	public $yearTo;
	
	public $ratingFrom;
	public $ratingTo;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'year'], 'integer'],
            [['name', 'image_path'], 'safe'],
            [['rating'], 'number'],
			[['genre'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = game::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'year' => $this->year,
            'genre' => $this->genre,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

/*		
		$query
			->andFilterWhere(['>=', 'rating', $this->ratingFrom])
			->andFilterWhere(['<=', 'rating', $this->ratingTo]);
*/	
	
        return $dataProvider;
    }
}
