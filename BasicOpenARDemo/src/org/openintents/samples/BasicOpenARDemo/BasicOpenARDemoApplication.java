package org.openintents.samples.BasicOpenARDemo;

import java.util.List;

import org.openintents.intents.WikitudePOI;

import android.app.Application;

public class BasicOpenARDemoApplication extends Application {
	/** the POIs **/
	private List<WikitudePOI> pois;
	
	public List<WikitudePOI> getPois() {
		return pois;
	}
	
	public void setPois(List<WikitudePOI> pois) {
		this.pois = pois;
	}
}
