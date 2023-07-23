/*
* File  : raisingEdgeFlg.v
* Author: Duohua(Edward) Wang
* Init  : 09/25/2021
*/

`timescale 1ns/100ps

module raisingEdgeFlg
(
	input  I_clk           ,
	input  I_rst           ,
	input  I_sigUnderDetect,
	output O_raisingEdgeFlg 
);

reg  lstSigal = 1'b0;
reg  fFlg     = 1'b0;

always @ (posedge I_clk)
	begin
		if(I_rst)
			begin
				lstSigal <= 1'b0;
				fFlg     <= 1'b0;
			end
		else
			begin
				lstSigal <= I_sigUnderDetect;
				if(I_sigUnderDetect > lstSigal)
					fFlg <= 1'b1;
				else
					fFlg <= 1'b0;
			end
	end

assign O_raisingEdgeFlg = fFlg;

endmodule
