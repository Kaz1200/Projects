package com.jc_hortinela.numberguesser;

import android.app.Activity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class MainActivity extends Activity {
	TextView showValue;
	 int result,counter=0;
	    static int getRandomNumber(int max, int min)
	    {
	        return (int)((Math.random()
	 * (max - min)) + min);
	    }
	  
	    public void makeToast(String str)
	    {
	        Toast.makeText(
	MainActivity.this, 
	str,
	 Toast.LENGTH_SHORT)
	.show();
	    }
	    public void clickFunction(View view)
	    {
	        int userGuessing;
	        EditText variable= (EditText)findViewById(R.id.editId);
	        userGuessing = Integer.parseInt(variable.getText().toString());
	        counter++;
	        showValue.setText(Integer.toString(counter));
	        if (userGuessing < result) {
	  
	            makeToast("Think of Higher Number,Try Again");
	        }
	        else if (userGuessing > result) {
	            makeToast("Think of Lower Number, Try Again");
	        }
	        else {
	            makeToast("Congratulations,"+" You Got the Number");
	            counter=0;
				Bundle savedInstanceState = null;
				onCreate(savedInstanceState);
				
	        }
	    }
	  
	    @Override
	    protected void onCreate(
	Bundle savedInstanceState)
	    {
	        super.onCreate(savedInstanceState);
	        setContentView(R.layout.activity_main);
	        showValue=(TextView)findViewById(R.id.textView4);
	        int min = 0;
	        int max = 100;
	        result = getRandomNumber(min, max);
	    }
	    
	                                         
	}
