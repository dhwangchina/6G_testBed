clc;clear
%% 生成单音信号的定点数据
FD_Enable = 0;
simglToneDataReFile = 'singleToneRe.coe';
simglToneDataImFile = 'singleToneIm.coe';
%% Parameters
fm = 2e6 ;         % 信号频率
fs = 122.88e6;     % 采样速率
w  = 2*pi*fm;
dt = 1/fs;         % 采样间隔
t  = 0:dt:dt*3275; % 3276个点
a  = 1;            % 信号幅度 
%% Data generator
data = a * exp(1i*w*t);

%% Time Domain Data,定点量化，采用Q（12,11）定标；
tdDataIm = round((2^11-1)*imag(data));
tdDataRe = round((2^11-1)*real(data));

writeData2File(simglToneDataImFile,tdDataIm);
writeData2File(simglToneDataReFile,tdDataRe);

figure(1);
plot(data);
figure(2);
hold on;
plot(tdDataIm);
hold on;
plot(tdDataRe);
%% 


%% 先对数据进行归一化，既除以信号幅度最大的值
if FD_Enable
dataFFT = fft(data,4096)./2906;

%% 定点量化，选择的是13位有效，且是有符号位，所以乘以(2^12-1)；
vectorReal = (2^12-1)*real(dataFFT);
vectorImag = (2^12-1)*imag(dataFFT);
%% 通过round函数进行截取
vectorRe = round(vectorReal);
vectorIm = round(vectorImag);

figure(1);
plot(vectorRe)
hold on;
plot(vectorIm);
end %% FD_Enable